<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;

trait MultiSelectTrait {
    private function getIDsList($collection, $request) {
        /**
         * Get multiple IDs in route by slashes (1/2/3)
         */
        $paramsBySegments = array_filter(array_slice($request->segments(), 1), function($item) {
            if (is_int($item)) return true;
            return false;
        });

        /**
         * Get multiple IDs in route by non-numeric character (1|2|3)
         */
        $paramsBySplit = preg_split("/[^0-9]/", $collection, -1, PREG_SPLIT_NO_EMPTY);

        /**
         * Get multiple IDs from POST if given by checkboxes
         */
        $paramsByPost = [];
        if (isset($request->id))
            if (gettype($request->id) == "array") $paramsByPost = $request->id;
            else $paramsByPost = preg_split("/[^0-9]/", $request->id, -1, PREG_SPLIT_NO_EMPTY);

        /**
         * Merge all lists together, then remove duplicates
         */
        $params = array_values(array_unique(array_merge($paramsBySplit, $paramsBySegments, $paramsByPost)));

        return $params;
    }
}
