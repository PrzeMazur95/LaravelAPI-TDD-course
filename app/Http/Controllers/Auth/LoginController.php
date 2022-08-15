<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Response;

class LoginController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function __invoke(LoginRequest $request)
    {
        $user = $this->user::whereEmail($request->email)->first();

        if (!$user || $request->password !== $user->password){
            return response('Credentials not match', Response::HTTP_UNAUTHORIZED);
        }

        return response([
            'token' => 'hello'
        ]);
    }
}
