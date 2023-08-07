<?php

namespace App\Commands\Repositories;

use App\Commands\Interfaces\AuthTokenRepositoryInterface;
use App\Commands\Interfaces\LoginRepositoryInterface;
use App\DTO\UserDTO;
use Illuminate\Support\Facades\Auth;

class LoginRepository implements LoginRepositoryInterface
{
    public function login(UserDTO $credentials): ?UserDTO
    {
        if (Auth::attempt(['email' => $credentials->email, 'password' => $credentials->password])) {
            $user = Auth::user();
            return new UserDTO($user['email'], $user['password']);
        } else {
            return null;
        }
    }
}
