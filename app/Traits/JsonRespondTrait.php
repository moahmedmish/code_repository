<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait JsonRespondTrait
{
    /**
     * THIS METHOD TO HELP RETURN JSON RESPONSE WITH SAME SIGNATURE IN ALL PLACES IN MY APPLICATION ALSO EASY TO EDITS IF WE NEED.
     *
     * @param string $message
     * @param array $errors
     * @param array $data
     * @param int $statusCode
     *
     * @return JsonResponse
     */
    function _ReturnJsonResponse($message = '', $errors = [], $data = [], $statusCode = Response::HTTP_OK)
    {
        return response()->json([
                    'Message' => $message,
                    'Errors'  => $errors ,
                    'Data'    => $data
                ], $statusCode);
    }
}
