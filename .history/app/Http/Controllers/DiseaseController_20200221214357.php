<?php

namespace App\Http\Controllers;

use App\Disease;
use App\DiseaseGroup;
use Illuminate\Http\Request;
use App\Http\Traits\MultiSelectTrait;
use App\Http\Traits\MassActionTrait;

class DiseaseController extends Controller
{
    use MultiSelectTrait;
    use MassActionTrait;

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
        $groups = DiseaseGroup::all();
        
        $results = [
            'entries' => count($params),
            'success' => count($diseases)
        ];
        $results['not_found'] = $results['entries'] - $results['success'];

        $message = $this->createMessage($results);
        
        $viewData = [
            'entries' => [],
            'groups' => $groups,
            'fields' => array_diff(array_keys(Disease::getAttributes()), ['id']),
        ];
        foreach ($diseases as $disease) $viewData['entries'][$disease->id] = $disease;

        dd($params, $message, $viewData);

        return view('disease.edit', [
            'disease' => $disease
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Disease  $disease
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Disease $disease)
    {
        //
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

        $message = $this->createMessage($results, [
            'fail' => 'layout.items_delete_error',
            'success' => 'layout.items_delete_success',
        ]);
        
        return redirect(route('disease.index'))->with(['message' => $message, 'time' => date("G:i:s")]);
    }
}
