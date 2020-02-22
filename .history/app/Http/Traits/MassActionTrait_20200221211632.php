<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;
use Closure;

trait MassActionTrait {
    private function process($collection, Closure $callback) {
        $successCounter = 0;
        $errorCounter = 0;
        $errorEntries = [];        

        foreach ($collection as $item) {
            try {
                call_user_func($callback, $item);
                $successCounter++;
            } catch (\Exception $ex) {
                $errorCounter++;
                array_push($errorEntries, $item);
            }
        }

        $result = [
            'fail' => $errorCounter,
            'failed_entries' => $errorEntries,
            'success' => $successCounter,
            'entries' => count($collection)
        ];
        return $result;
    }
    
    private function createMessage($processResults, $texts = []) {
        $processResults = (array) $processResults;
        if (!isset($texts) || gettype($texts) != "array") $texts = [];
        $texts = array_merge([
            'not_found' => 'layout.not_found',
            'fail' => 'layout.items_action_error',
            'success' => 'layout.items_action_success',
        ], $texts);
        $message = [];

        if (isset($processResults['success']) && $processResults['success'] > 0) array_push($message, trans_choice($text['success'], $processResults['success'], ['count' => $processResults['success']]));

        if (isset($processResults['fail']) && $processResults['fail'] > 0) array_push($message, trans_choice($text['fail'], $processResults['fail'], ['count' => $processResults['fail']]));
        

        $notFound = 0;
        if (isset($processResults['entries'])) $notFound = $processResults['entries'] - ($processResults['success'] + $processResults['fail']);
        if (isset($processResults['not_found'])) $notFound = $processResults['not_found'];
        
        if (isset($notFound) && $notFound > 0) array_push($message, trans_choice($text['fail'], $notFound, ['count' => $notFound]));

        $message = implode("<br>", $message);

        return $message;
    }
}
