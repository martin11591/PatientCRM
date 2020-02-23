<?php

namespace App\Http\Controllers;

use App\MedicineGroup;
use Illuminate\Http\Request;

class MedicineGroupController extends Controller
{
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

        return view('generic_simple_form', [
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
    public function edit(MedicineGroup $medicineGroup)
    {
        //
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
