<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MessageController as MessageController;
use App\Http\Resources\AuthResource;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends MessageController
{

    public function loginUser(Request $request )
    {

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){

            $user = Auth::user();

            $data = new AuthResource($user);

            return $this->sendResponse($data, 'User login successfully');

        } else {

            return $this->sendError('Unauthorized', ['error' => 'Unauthorized']);

        }

    }

}
