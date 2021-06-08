<?php

namespace App\Http\Traits;

trait JSONResponse
{
    public function errorResponse($message = '', $code = 404)
    {
        return response()->json([
            'status' => false,
            'status_code' => $code,
            'message' => $message
        ]);
    }

    public function successResponse($message = '', $data = [], $code = 200)
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data,
            'status_code' => $code,
        ]);
    }
}
