<?php

namespace App\Traits\V1;

use Illuminate\Http\JsonResponse;

use function PHPUnit\Framework\isEmpty;

trait ApiResponse
{
    public static function success($message = 'ok', $data = [], $statusCode = 200): JsonResponse
    {

        $fin = [
            'success' => true,
            'message' => $message,    
        ];

        if(!empty($data))
        {
            $fin['data'] = $data;
        }

        return response()->json($fin,$statusCode);
    }


    public static function fail($message='something went wrong', $errors = [], $statusCode=500) : JsonResponse
    {
        $fin = [
            'success' => false,
            'message' => $message   
        ];

        if(!empty($errors))
            $fin['errors'] = $errors;

        return response()->json($fin, $statusCode);
    }
}
