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
    public function update(Request $request, Medicine $medicine)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function destroy(Medicine $medicine, Request $request)
    {
        dd($medicine);
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

        $action = $this->process($medicines, function($item) {
            $item->delete();
        });

        $message = $this->createMessage($action, $params);
        
        return redirect(route('medicine.index'))->with(['message' => $message, 'time' => date("G:i:s")]);
    }
}
