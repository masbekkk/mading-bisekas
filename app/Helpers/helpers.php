<?php

if (!function_exists('formatResponse')) {
    function formatResponse($status, $message, $data = null, $errors = null, $httpCode = 200)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
            'errors' => $errors
        ], is_int($httpCode) ? $httpCode : 500);
    }
}
