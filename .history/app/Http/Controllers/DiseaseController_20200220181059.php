<?php

namespace App\Http\Controllers;

use App\Disease;
use Illuminate\Http\Request;

class DiseaseController extends Controller
{
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
    public function edit(Disease $disease)
    {
        return view('disease.edit', [
            'fields' => array_diff(array_keys($disease->getAttributes()), ['id']),
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
        /**
         * Get multiple IDs in route by slashes (1/2/3)
         */
        $paramsBySegments = array_slice($request->segments(), 1);

        /**
         * Get multiple IDs in route by non-numeric character (1|2|3)
         */
        $paramsBySplit = preg_split("/[^0-9]/", $disease, -1, PREG_SPLIT_NO_EMPTY);

        /**
         * Merge both lists together, then
         * Remove duplicates
         */
        $params = array_values(array_unique(array_merge($paramsBySplit, $paramsBySegments)));

        $diseases = Disease::find([$params]);
        dd($params, $request, $diseases);
        try {
            $disease->delete();
        } catch (\Exception $ex) {
            return redirect(route('disease.index'))->with('message', 'layout.delete_error');
        }

        return redirect(route('disease.index'))->with('message', 'layout.deleted_success');
    }
}
