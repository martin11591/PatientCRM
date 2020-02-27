<?php

namespace App\Http\Controllers;

use App\MedicineGroup;
use Illuminate\Http\Request;
use App\Http\Traits\MultiSelectTrait;
use App\Http\Traits\MassActionTrait;

class MedicineGroupController extends Controller
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
        $medicineGroups = MedicineGroup::paginate($perPage);
        
        $fields = [];
        if (isset($medicineGroups[0])) $fields = array_diff(array_keys($medicineGroups[0]->getAttributes()), ['id']);

        return view('generic.table_show', [
            'title' => 'medicine_group',
            'route' => 'medicine.group',
            'entries' => $medicineGroups,
            'fields' => $fields,
            'perPage' => $perPage,
        ]);
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
        $fields = \DB::getSchemaBuilder()->getColumnListing((new MedicineGroup)->table);

        /**
         * Hide columns which shouldn't be edited
         */
        $fields = array_diff($fields, ['id']);

        $empty = new MedicineGroup;
        $empty->fill(array_combine($fields, array_fill(0, count($fields), null)));

        dd($empty->toArray());
        
        $viewData = [
            'title' => 'medicine_group',
            'route' => 'medicine.group',
            'fields' => $fields,
            'amount' => $amount,
            'entries' => $empty->toArray()
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
                MedicineGroup::create($entry);
                $succeed++;
                \DB::commit();
            } catch (\Exception $e) {
                array_push($messages, $e->getMessage());
                $failed++;
                \DB::rollBack();
            }
        }
        
        $messages = array_merge($this->createMessage(['success' => $succeed, 'fail' => $failed]));

        return redirect()->route('medicine.group.index')->with('messages', $messages);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MedicineGroup  $medicineGroup
     * @return \Illuminate\Http\Response
     */
    public function show(MedicineGroup $medicineGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MedicineGroup  $medicineGroup
     * @return \Illuminate\Http\Response
     */
    public function edit($medicineGroup, Request $request)
    {
        $params = $this->getIDsList($medicineGroup, $request);
        
        $medicineGroups = MedicineGroup::find($params);

        $results = [
            // 'success' => count($medicines),
            'not_found' => count($params) - count($medicineGroups)
        ];
        
        $messages = $this->createMessage($results);
        
        /**
         * Get columns from model table
         */
        $fields = \DB::getSchemaBuilder()->getColumnListing((new MedicineGroup)->table);

        /**
         * Hide columns which shouldn't be edited
         */
        $fields = array_diff($fields, ['id']);

        $viewData = [
            'title' => 'medicine_group',
            'route' => 'medicine.group',
            'entries' => $medicineGroups,
            'fields' => $fields,
            'messages' => $messages
        ];

        return view('generic.edit', $viewData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MedicineGroup  $medicineGroup
     * @return \Illuminate\Http\Response
     */
    public function update($medicineGroup, Request $request)
    {
        $params = $this->getIDsList(implode("/", array_keys($request['entry'])), $request);
        
        $medicineGroups = MedicineGroup::find($params);

        $results = [
            'not_found' => count($params) - count($medicineGroups)
        ];
        
        \DB::beginTransaction();

        $succeed = 0;

        $messages = [];

        try {
            foreach ($medicineGroups as $entry) {
                $entry->update($request
                ['entry'][$entry->id]);
                $succeed++;
            }

            \DB::commit();
        } catch(\Exception $e) {
            \DB::rollBack();
            array_push($messages, $e->getMessage());
        }

        $result['success'] = $succeed;

        $messages = array_merge($messages, $this->createMessage($results));

        return redirect()->route('medicine.group.index')->with('messages', $messages);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MedicineGroup  $medicineGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy($medicineGroups, Request $request)
    {
        $params = $this->getIDsList($medicineGroups, $request);
        
        /**
         * Get all specified entries
         */
        $groups = MedicineGroup::find($params);

        /**
         * Do job on every item
         * Route param 'medicine' ($medicineGroups)
         * Becomes medicine model entry
         */

        $results = $this->process($groups, function($item) {
            $item->delete();
        });
        $results['not_found'] = count($params) - count($groups);

        $messages = $this->createMessage($results, [
            'fail' => 'layout.items_delete_error',
            'success' => 'layout.items_delete_success',
        ]);
        
        return redirect(route('medicine.group.index'))->with(['messages' => $messages]);
    }
}
