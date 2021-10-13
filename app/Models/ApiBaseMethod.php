<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiBaseMethod extends Model
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public static function sendResponse($result, $message)
    {

        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];

        return response()->json($response, 200);
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public static function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];


        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }


        return response()->json($response, $code);
    }
    public static function sendUnAuthorized($result, $message)
    {

        $response = [
            'success' => false,
            'message' => 'Wrong API Token',
        ];

        return response()->json($response, 401);
    }
    public static function wrongPurchaseCode($result, $message)
    {

        $response = [
            'success' => false,
            'message' => 'Wrong Purchase Code',
        ];

        return response()->json($response, 404);
    }


    // Return url
    public static function checkUrl($url)
    {
        $data = explode('/', $url);
        if (in_array('api', $data)) {
            return true;
        } else {
            return false;
        }
    }
}
