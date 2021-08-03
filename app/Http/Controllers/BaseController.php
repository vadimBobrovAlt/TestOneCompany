<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BaseController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendResponse($result, $message = '', $code = 200)
    {
        try {
            $response = [
                'data' => $result,
                'message' => $message,
            ];

            return response()->json($response, $code);
        } catch (\Exception $e) {
            Log::channel('api_custom')->error($e->getMessage());
            return response()->json('Возникла ошибка', 500);
        }
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
        try {
            $response = [
                'message' => $error,
            ];

            if (!empty($errorMessages)) {
                $response['data'] = $errorMessages;
            }

            return response()->json($response, $code);
        } catch (\Exception $e) {
            Log::channel('api_custom')->error($e->getMessage());
            return response()->json('Возникла ошибка', 500);
        }
    }
}
