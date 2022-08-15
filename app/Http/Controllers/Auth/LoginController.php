<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Models\User;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request)
    {
        $user = User::where(['email', $request->email]);

        // if (!$user){
        //     return response('Credentials not match', Response::HTTP_UNAUTHORIZED);
        // }

        return response([
            'token' => 'hello'
        ]);
    }
}
