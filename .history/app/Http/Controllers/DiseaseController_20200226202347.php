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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        
        $fields = [];
        if (isset($diseases[0])) $fields = array_diff(array_keys($diseases[0]->getAttributes()), ['id']);
        
        if (isset($groupsModel[0])) {
            $fields["groups"] = array_diff(array_keys($groupsModel[0]->getAttributes()), ['id']);
        }

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

        $messages = [];

        \DB::beginTransaction();

        // dd($request);
        // REQUEST STATE
        $txt = "";
        foreach ($request['entry'] as $id => $val) $txt .= ($txt == "" ? "" : "<br><br>") . "{$val['name']} ($id)}<br><br>" . implode(", ", $val['groups']);

        array_push($messages, $txt);

        try {
            foreach ($diseases as $disease) {
                $action = false;
                $groups = $disease->groups()->get();
                
                // REMOVING GROUPS WHICH ARE SELECTED AS EMPTY OR NOT LISTED
                foreach ($groups as $group) {
                    if (array_search($group->id, $request['entry'][$disease->id]['groups']) === false) {
                        $action = true;
                        $disease->groups()->detach();
                    }
                }

                // ADDING GROUPS WHICH ARE SELECTED AND AREN'T ASSIGNED
                foreach ($request['entry'][$disease->id]['groups'] as $group => $entry) {
                    if ($entry === null) continue;
                    if ($disease->groups->contains($entry) === false) {
                        $action = true;
                        $disease->groups()->attach($entry);
                    }
                }

                if ($action === true) $succeed++;
            }
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollBack();
            array_push($messages, $e->getMessage());
        }
        
        $results['success'] = $succeed;

        $messages = array_merge($messages, $this->createMessage($results));

        if ($succeed == 0) array_push($messages, __('layout.no_changes'));

        // dd($request);
        
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
            $item->delete();
        });
        $results['not_found'] = count($params) - count($diseases);

        $messages = $this->createMessage($results, [
            'fail' => 'layout.items_delete_error',
            'success' => 'layout.items_delete_success',
        ]);
        
        return redirect(route('disease.index'))->with(['messages' => $messages]);
    }
}
