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
        $result->entriesAmount = count($collection);
        return $result;
    }
    
    private function createMessage($processResults, $texts) {
        $message = [];

        if (isset($processResults->succeeded) && $processResults->succeeded > 0) {
            if ($processResults->succeeded == 1) array_push($message, __('layout.deleted_success'));
            else array_push($message, __('layout.deleted_success_many', ['count' => $processResults->succeeded]));
        }
        if (isset($processResults->failed) && $processResults->failed > 0) {
            if ($processResults->failed == 1) array_push($message, __('layout.delete_error'));
            else array_push($message, __('layout.delete_error_many', ['count' => $processResults->failed]));
        }

        if (isset($processResults->entriesAmount)) {
            $notFoundCount = $processResults->entriesAmount - ($processResults->succeeded + $processResults->failed);
            if ($notFoundCount == 1) array_push($message, __('layout.not_found'));
            else if ($notFoundCount > 1) array_push($message, __('layout.not_found_many', ['count' => $notFoundCount]));
        }

        $message = implode("<br>", $message);

        return $message;
    }
}
