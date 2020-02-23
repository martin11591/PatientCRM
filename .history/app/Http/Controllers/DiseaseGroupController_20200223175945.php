<?php

namespace App\Http\Controllers;

use App\DiseaseGroup;
use Illuminate\Http\Request;
use App\Http\Traits\MultiSelectTrait;
use App\Http\Traits\MassActionTrait;

class DiseaseGroupController extends Controller
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
        $diseaseGroups = DiseaseGroup::paginate($perPage);
        
        $fields = [];
        if (isset($diseaseGroups[0])) $fields = array_diff(array_keys($diseaseGroups[0]->getAttributes()), ['id']);

        return view('generic.table_show', [
            'title' => 'disease_group',
            'route' => 'disease.group',
            'entries' => $diseaseGroups,
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
     * @param  \App\DiseaseGroup  $diseaseGroup
     * @return \Illuminate\Http\Response
     */
    public function show(DiseaseGroup $diseaseGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DiseaseGroup  $diseaseGroup
     * @return \Illuminate\Http\Response
     */
    public function edit($diseaseGroup, Request $request)
    {
        $params = $this->getIDsList($diseaseGroup, $request);
        
        $diseaseGroups = DiseaseGroup::find($params);

        $results = [
            // 'success' => count($diseases),
            'not_found' => count($params) - count($diseaseGroups)
        ];
        
        $messages = $this->createMessage($results);
        
        $fields = [];
        if (isset($diseaseGroups[0])) $fields = array_diff(array_keys($diseaseGroups[0]->getAttributes()), ['id']);

        $viewData = [
            'title' => 'disease_group',
            'route' => 'disease.group',
            'entries' => $diseaseGroups,
            'fields' => $fields,
            'messages' => $messages
        ];

        return view('generic.edit', $viewData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DiseaseGroup  $diseaseGroup
     * @return \Illuminate\Http\Response
     */
    public function update($diseaseGroup, Request $request)
    {
        $params = $this->getIDsList($diseaseGroup, $request);
        
        $diseaseGroups = DiseaseGroup::find($params);

        $results = [
            // 'success' => count($diseases),
            'not_found' => count($params) - count($diseaseGroups)
        ];
        
        $messages = $this->createMessage($results);

        dd($diseaseGroup, $params, $results, $diseaseGroups, $request);

        \DB::beginTransaction();

        $succeed = 0;
        $failed = 0;

        try {
            foreach ($diseaseGroups as $entry) {
                $entry->update[$request[$entry->id]];
            }
            
            \DB::commit();
        } catch(\Exception $e) {
            \DB::rollBack();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DiseaseGroup  $diseaseGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(DiseaseGroup $diseaseGroup)
    {
        //
    }
}
