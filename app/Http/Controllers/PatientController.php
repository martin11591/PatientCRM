<?php

namespace App\Http\Controllers;

use App\UserProfile;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    //

    public function index(Request $request) {        
        $perPage = intval($request->get('perPage', 10));
        if (is_nan($perPage)) $perPage = 10;
        $patients = UserProfile::paginate($perPage);
        
        /**
         * Get columns from model table
         */
        $fields = \DB::getSchemaBuilder()->getColumnListing((new UserProfile)->getTable());

        /**
         * Hide columns which shouldn't be edited
         */
        $fields = array_diff($fields, ['id', 'user_id']);

        return view('generic.table_show', [
            'title' => 'patient',
            'route' => 'patient',
            'entries' => $patients,
            'fields' => $fields,
            'perPage' => $perPage,
        ]);
    }
}
