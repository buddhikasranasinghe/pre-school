<?php

namespace App\Http\Controllers\Auth;

use App\Commands\Interfaces\AuthTokenRepositoryInterface;
use App\Commands\Interfaces\LoginRepositoryInterface;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\DTO\UserDTO;
use App\Responses\ReturnResponse;
use Illuminate\Support\Facades\Validator;
use App\Services\AuthService;

class AuthenticationController extends Controller
{
    protected $loginRepositoryInterface;
    protected $authTokenRepositoryInterface;

    public function __construct(
        LoginRepositoryInterface $loginRepositoryInterface,
        AuthTokenRepositoryInterface $authTokenRepositoryInterface
    )
    {
        $this->loginRepositoryInterface = $loginRepositoryInterface;
        $this->authTokenRepositoryInterface = $authTokenRepositoryInterface;
    }

    public function login(Request $request): JsonResponse
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => 400.,
                'message' => $validate->errors()
            ]);
        }

        $auth_service = new AuthService(
            $request->input('email'), 
            $request->input('password'),
            $this->loginRepositoryInterface,
            $this->authTokenRepositoryInterface
        );

        return response()->json($auth_service->checkVaidation());
    }
}
