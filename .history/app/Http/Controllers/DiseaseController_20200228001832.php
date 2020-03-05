<?php

namespace App\Http\Controllers;

use App\Disease;
use App\DiseaseGroup;
use Illuminate\Http\Request;
use App\Http\Traits\MultiSelectTrait;
use App\Http\Traits\MassActionTrait;
use Illuminate\Support\Facades\Session;

class DiseaseController extends Controller
{
    use MultiSelectTrait;
    use MassActionTrait;

    public function __construct() {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $diseases = Disease::all();
        $perPage = intval($request->input('perPage', 10));
        if (is_nan($perPage)) $perPage = 10;
        $diseases = Disease::with('groups')->paginate($perPage);
        return view('disease.index', ['diseases' => $diseases, 'perPage' => $perPage]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($amount = 1)
    {
        $amount = (int)($amount);
        if ($amount < 1) $amount = 1;

        /**
         * Get columns from model table
         */
        $fields = \DB::getSchemaBuilder()->getColumnListing((new Disease)->getTable());

        /**
         * Hide columns which shouldn't be edited
         */
        $fields = array_diff($fields, ['id']);

        $empty = new Disease;
        $empty->fill(array_combine($fields, array_fill(0, count($fields), null)));

        $entries = array_combine(range(1, $amount), array_fill(1, $amount, $empty));

        $viewData = [
            'title' => 'disease',
            'route' => 'disease',
            'fields' => $fields,
            'amount' => $amount,
            'entries' => $entries,
            'empty' => true
        ];

        return view('generic.create_or_edit', $viewData);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $succeed = 0;
        $failed = 0;

        $messages = [];

        foreach ($request->entry as $entry) {
            \DB::beginTransaction();
            try {
                Disease::create($entry);
                $succeed++;
                \DB::commit();
            } catch (\Exception $e) {
                array_push($messages, $e->getMessage());
                $failed++;
                \DB::rollBack();
            }
        }
        
        $messages = array_merge($this->createMessage(['success' => $succeed, 'fail' => $failed]));

        return redirect()->route('disease.index')->with('messages', $messages);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Disease  $disease
     * @return \Illuminate\Http\Response
     */
    public function show(Disease $disease)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Disease  $disease
     * @return \Illuminate\Http\Response
     */
    public function edit($disease, Request $request)
    {
        $params = $this->getIDsList($disease, $request);
        
        $diseases = Disease::with('groups')->find($params);
        $groupsModel = DiseaseGroup::all();
        $groups = [];
        
        foreach ($groupsModel as $item) $groups[$item->id] = $item->name;
        
        $results = [
            // 'success' => count($diseases),
            'not_found' => count($params) - count($diseases)
        ];
        
        $messages = $this->createMessage($results);
        
        $fields = \DB::getSchemaBuilder()->getColumnListing((new Disease)->getTable());
        $fields = array_diff($fields, ['id']);
        
        $fields["groups"] = \DB::getSchemaBuilder()->getColumnListing((new DiseaseGroup)->getTable());
        $fields["groups"] = array_diff($fields["groups"], ['id']);

        $viewData = [
            'entries' => [],
            'relation' => 'groups',
            'groups' => $groups,
            'fields' => $fields,
            'messages' => $messages
        ];
        foreach ($diseases as $disease) $viewData['entries'][$disease->id] = $disease;

        return view('disease.edit', $viewData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Disease  $disease
     * @return \Illuminate\Http\Response
     */
    public function update($disease, Request $request)
    {
        $params = $this->getIDsList(implode("/", array_keys($request['entry'])), $request);
        
        $diseases = Disease::with('groups')->find($params);

        $results = [
            'not_found' => count($params) - count($diseases)
        ];

        $succeed = 0;
        $failed = 0;

        $messages = [];
        
        $fields = \DB::getSchemaBuilder()->getColumnListing((new Disease)->getTable());
        $fields = array_diff($fields, ['id']);

        \DB::beginTransaction();

        foreach ($diseases as $disease) {
            try {
                $entry = array_filter($request['entry'][$disease->id], function() {
                    dump($this);
                    if (gettype($this) == "array") return false;
                    return true;
                });
                dd($fields, $entry);
                $disease->fill(array_combine($fields, $request['entry'][$disease->id]));
                $disease->save();
                $disease->groups()->sync(array_filter($request['entry'][$disease->id]['groups'], function($item) {
                    if ($item !== null) return true;
                    return false;
                }));
                $succeed++;
                \DB::commit();
            } catch (\Exception $e) {
                \DB::rollBack();
                array_push($messages, $disease->id . " => " . $e->getMessage());
                $failed++;
            }
        }
        
        $results['success'] = $succeed;
        $results['fail'] = $failed;

        $messages = array_merge($messages, $this->createMessage($results));

        if ($succeed == 0 && $failed == 0) array_push($messages, __('layout.no_changes'));
        
        return redirect()->route('disease.edit', implode("/", $params))->with('messages', $messages);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Disease  $disease
     * @return \Illuminate\Http\Response
     */
    public function destroy($disease, Request $request)
    {
        $params = $this->getIDsList($disease, $request);
        
        /**
         * Get all specified entries
         */
        $diseases = Disease::find($params);

        /**
         * Do job on every item
         * Route param 'disease' ($disease)
         * Becomes Disease model entry
         */

        $results = $this->process($diseases, function($item) {
            \DB::beginTransaction();
            try {
                $item->groups()->detach();
                $item->delete();
                \DB::commit();
            } catch (\Exception $e) {
                \DB::rollBack();
                throw new Exception ($e);
            }
        });
        $results['not_found'] = count($params) - count($diseases);

        $messages = $this->createMessage($results, [
            'fail' => 'layout.items_delete_error',
            'success' => 'layout.items_delete_success',
        ]);
        
        return redirect(route('disease.index'))->with(['messages' => $messages]);
    }
}
