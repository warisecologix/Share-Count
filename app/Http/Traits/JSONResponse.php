<?php

namespace App\Http\Traits;

trait JSONResponse
{
    public function errorResponse($message = '',  $code = 404 , $data = '', $optional_status='')
    {
        return response()->json([
            'status' => false,
            'status_code' => $code,
            'data' => $data,
            'message' => $message,
            'optional_status' => $optional_status
        ]);
    }

    public function successResponse($message = '', $data = '', $code = 200, $optional_status='')
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data,
            'status_code' => $code,
            'optional_status' => $optional_status
        ]);
    }
}
