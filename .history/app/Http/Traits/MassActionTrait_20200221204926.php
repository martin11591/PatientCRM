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

        $result = new \stdClass();
        $result->failed = $errorCounter;
        $result->failedEntries = $errorEntries;
        $result->succeeded = $successCounter;
        $result->entries = count($collection);
        $result->notFound = $result->entries - ($successCounter + $errorCounter);
        return $result;
    }
    
    private function createMessage($processResults, $texts = []) {
        $processResults = (array) $processResults;
        if (!isset($texts) || gettype($texts) != "array") $texts = [];
        $texts = array_merge([
            'not_found' => 'layout.not_found',
            'fail' => 'layout.item_action_error',
            'success' => 'layout.item_action_success',
        ], $texts);
        $message = [];

        if (isset($processResults->succeeded) && $processResults->succeeded > 0) {
            if ($processResults->succeeded == 1) array_push($message, __($texts['success']));
            else array_push($message, __($texts['success_many'], ['count' => $processResults->succeeded]));
        }
        if (isset($processResults->failed) && $processResults->failed > 0) {
            if ($processResults->failed == 1) array_push($message, __($texts['fail']));
            else array_push($message, __($texts['fail_many'], ['count' => $processResults->failed]));
        }

        if (isset($processResults->entries)) {
            $notFoundCount = $processResults->entries - ($processResults->succeeded + $processResults->failed);
            if ($notFoundCount == 1) array_push($message, __($texts['not_found']));
            else if ($notFoundCount > 1) array_push($message, __($texts['not_found_many'], ['count' => $notFoundCount]));
        }

        $message = implode("<br>", $message);

        return $message;
    }
}
