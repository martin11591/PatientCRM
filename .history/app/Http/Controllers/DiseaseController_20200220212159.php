<?php

namespace App\Http\Controllers;

use App\Disease;
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
        $message = [];

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

        $successCounter = 0;
        $errorCounter = 0;
        $errorEntries = [];

        foreach ($diseases as $disease) {
            try {
                $disease->delete();
                $successCounter++;
            } catch (\Exception $ex) {
                $errorCounter++;
                array_push($errorEntries, $disease);
            }
        }

        if ($successCounter > 0) {
            if ($successCounter == 1) array_push($message, __('layout.deleted_success'));
            else array_push($message, __('layout.deleted_success_many', ['count' => $successCounter]));
        }
        if ($errorCounter > 0) {
            if ($errorCounter == 1) array_push($message, __('layout.delete_error'));
            else array_push($message, __('layout.delete_error_many', ['count' => $errorCounter]));
        }

        $notFoundCount = count($params) - count($diseases);
        if ($notFoundCount == 1) array_push($message, __('layout.not_found'));
        else if ($notFoundCount > 1) array_push($message, __('layout.not_found_many', ['count' => $notFoundCount]));

        $message = implode("<br>", $message);
        
        return redirect(route('disease.index'))->with(['message' => $message, 'time' => date("G:i:s")]);
    }
}
