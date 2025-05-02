<?php

namespace App\Http\Controllers;

abstract class Controller
{
    /**
     * Generate a standard API response
     *
     * @param bool $success Indicates if the response is successful
     * @param string $message The message to include in the response
     * @param $data The data to include in the response (optional)
     * @param int $statusCode The HTTP status code (default is 200)
     * @return JsonResponse The JSON response
     */
    protected function apiResponse($success, $message, $data = null, $statusCode = 200)
    {
        return response()->json([
            'success' => $success,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }

    /**
     * Generate a success response
     *
     * @param string $message The success message
     * @param $data The data to include in the response (optional)
     * @param int $statusCode The HTTP status code (default is 200)
     * @return JsonResponse The JSON success response
     */
    protected function successResponse($message, $data = null, $statusCode = 200)
    {
        return $this->apiResponse(true, $message, $data, $statusCode);
    }

    /**
     * Generate an error response
     *
     * @param string $message The error message
     * @param $data The data to include in the response (optional)
     * @param int $statusCode The HTTP status code (default is 400)
     * @return JsonResponse The JSON error response
     */
    protected function errorResponse($message, $data = null, $statusCode = 400)
    {
        return $this->apiResponse(false, $message, $data, $statusCode);
    }
}
