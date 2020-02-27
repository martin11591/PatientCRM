<?php

namespace App\Http\Controllers;

use App\Medicine;
use Illuminate\Http\Request;
use App\Http\Traits\MultiSelectTrait;
use App\Http\Traits\MassActionTrait;

class MedicineController extends Controller
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
        $perPage = intval($request->input('perPage', 10));
        if (is_nan($perPage)) $perPage = 10;
        $medicines = Medicine::with('groups')->paginate($perPage);
        return view('medicine.index', ['medicines' => $medicines, 'perPage' => $perPage]);
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
        $fields = \DB::getSchemaBuilder()->getColumnListing((new Medicine)->getTable());

        /**
         * Hide columns which shouldn't be edited
         */
        $fields = array_diff($fields, ['id']);

        $empty = new Medicine;
        $empty->fill(array_combine($fields, array_fill(0, count($fields), null)));

        $entries = array_combine(range(1, $amount), array_fill(1, $amount, $empty));

        $viewData = [
            'title' => 'medicine',
            'route' => 'medicine',
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
                Medicine::create($entry);
                $succeed++;
                \DB::commit();
            } catch (\Exception $e) {
                dd($e);
                array_push($messages, $e->getMessage());
                $failed++;
                \DB::rollBack();
            }
        }
        
        $messages = array_merge($this->createMessage(['success' => $succeed, 'fail' => $failed]));

        return redirect()->route('medicine.index')->with('messages', $messages);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function show(Medicine $medicine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function edit(Medicine $medicine)
    {
        return view('medicine.edit', [
            'fields' => array_diff(array_keys($medicine->getAttributes()), ['id']),
            'medicine' => $medicine
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function update($medicine, Request $request)
    {
        $params = $this->getIDsList(implode("/", array_keys($request['entry'])), $request);
        
        $medicines = Disease::with('groups')->find($params);

        $results = [
            'not_found' => count($params) - count($medicines)
        ];

        $succeed = 0;
        $failed = 0;

        $messages = [];

        \DB::beginTransaction();

        foreach ($medicines as $medicine) {
            try {
                $medicine->groups()->sync(array_filter($request['entry'][$medicine->id]['groups'], function($item) {
                    if ($item !== null) return true;
                    return false;
                }));
                $succeed++;
                \DB::commit();
            } catch (\Exception $e) {
                \DB::rollBack();
                array_push($messages, $medicine->id . " => " . $e->getMessage());
                $failed++;
            }
        }
        
        $results['success'] = $succeed;
        $results['fail'] = $failed;

        $messages = array_merge($messages, $this->createMessage($results));

        if ($succeed == 0 && $failed == 0) array_push($messages, __('layout.no_changes'));
        
        return redirect()->route('medicine.edit', implode("/", $params))->with('messages', $messages);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function destroy($medicine, Request $request)
    {
        $params = $this->getIDsList($medicine, $request);
        
        /**
         * Get all specified entries
         */
        $medicines = Medicine::find($params);

        /**
         * Do job on every item
         * Route param 'disease' ($medicine)
         * Becomes Disease model entry
         */

        $results = $this->process($medicines, function($item) {
            $item->delete();
        });
        $results['not_found'] = count($params) - count($medicines);

        $messages = $this->createMessage($results, [
            'fail' => 'layout.items_delete_error',
            'success' => 'layout.items_delete_success',
        ]);
        
        return redirect(route('medicine.index'))->with(['messages' => $messages]);
    }
}
