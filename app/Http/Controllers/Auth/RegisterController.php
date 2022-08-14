<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{
    //when you do not have any function, you can use invoke method, it will call it automatically by controller call, look in api.php
    //like construct, but you do not have to instantiate a class
    public function __invoke(RegisterRequest $request)
    {
        //validated - it will only take those values which is in registerRequest, it could be laso all(), but then you will take all data
        User::create($request->validated());
        // User::create($request->all());
        return response([],201);
    }
}
