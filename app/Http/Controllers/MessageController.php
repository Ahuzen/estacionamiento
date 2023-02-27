<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageController extends Controller
{

    //metodo que responde con estado success

    public function sendResponse($result, $message, $code = 200)
    {
    	$response = [
            'success' => true,
            'codigo' => $code,
            'message' => $message,
            'data'    => $result
        ];


        return response()->json($response, 200);
    }

    //metodo que responde con estado error

    public function sendError($error, $errorMessages = [], $code = 404)
    {
    	$response = [
            'success' => false,
            'codigo' => $code,
            'message' => $error,
        ];


        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }


        return response()->json($response, $code);
    }

}
