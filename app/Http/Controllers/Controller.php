<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

abstract class Controller
{

    public function response($data): JsonResponse
    {
        return response()->json([
            'data' => $data
        ]);
    }

    public function success(string $message = null, $data = null): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'success' => true,
            'message' => $message ?? 'operation successful',
            'data' => $data
        ]);
    }

    public function error(string $message = null, $data = null): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'success' => false,
            'message' => $message ?? 'error occured',
            'data' => $data
        ], 400);
    }
}
