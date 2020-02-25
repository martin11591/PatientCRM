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
        
        $fields = [];
        if (isset($medicineGroups[0])) $fields = array_diff(array_keys($medicineGroups[0]->getAttributes()), ['id']);

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
    public function update(Request $request, MedicineGroup $medicineGroup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MedicineGroup  $medicineGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(MedicineGroup $medicineGroup)
    {
        //
    }
}