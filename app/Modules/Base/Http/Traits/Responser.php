<?php

namespace App\Modules\Base\Http\Traits;

use Illuminate\Http\JsonResponse;

trait Responser
{
    /**
     * Return a successful JSON response
     *
     * @param  int  $status  HTTP status code (default: 200)
     * @param  string  $message  Success message
     * @param  mixed  $data  Response data
     */
    protected function responseSuccess(int $status = 200, string $message = 'Success', mixed $data = []): JsonResponse
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ], $status);
    }

    /**
     * Return a failed JSON response
     *
     * @param  int  $status  HTTP status code (default: 422)
     * @param  string  $message  Error message
     * @param  mixed  $data  Error data
     */
    protected function responseFail(int $status = 422, string $message = 'Failed', mixed $data = []): JsonResponse
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ], $status);
    }
}
