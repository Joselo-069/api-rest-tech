<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAuthRequest;
use App\Http\Requests\StoreLoginRequest;
use App\Http\Responses\ApiResponse;
use App\Services\AuthService;
use Auth;

class AuthController extends Controller
{

    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(StoreAuthRequest $request) {

        $dataUser = $this->authService->getRegisterUser($request);
        return ApiResponse::successResponse($dataUser);
    }

    public function loginUser(StoreLoginRequest $request) {

        if (Auth::attempt($request->only('email', 'password'))) {

            $dataLogin = $this->authService->getLoginUser($request);

            return ApiResponse::successResponse($dataLogin);
        }

        return ApiResponse::errorResponseAuth();
    }

    public function logout() {
        Auth::user()->tokens()->delete();
        return ApiResponse::successResponse(['menssage' => "logout sucess"]);
    }
}
