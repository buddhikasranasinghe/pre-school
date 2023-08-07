<?php

namespace App\Commands\Repositories;

use App\Commands\Interfaces\AuthTokenRepositoryInterface;
use App\Models\User;
use App\Responses\ReturnResponse;
use Exception;
use Illuminate\Support\Str;

class AuthTokenRepository implements AuthTokenRepositoryInterface
{
    public function createToken(string $email): array
    {
        try {
            User::where('email', $email)->update(['api_token' => Str::random(60)]);
            return [
                'status' => 200, 
                'message' => 'Token Created'
            ];
        } catch (Exception $e) {
            return [
                'status' => 500, 
                'message' => $e->getMessage()
            ];
        }
    }
}
