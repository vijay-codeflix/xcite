<?php

namespace App\Helper;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use stdClass;

class ResponseHelper
{

    public static function sendError($message, $error = [], $code = Response::HTTP_UNAUTHORIZED)
    {
        $response = [

            'success' => false,
            'status' => $code,
            'message' => $message,
            'result' => (object)$error
        ];

        throw new HttpResponseException(response()->json($response, $code));
    }
    public static function sendSuccess($message, $data = [], $code = Response::HTTP_OK)
    {
        $response = [
            'success' => false,
            'status' => $code,
            'message' => $message,
        ];
        if (!empty($data)) {
            $response['result'] = $data;
        } else {
            $response['result'] = new stdClass();
        }

        throw new HttpResponseException(response()->json($response, $code));
    }
}
