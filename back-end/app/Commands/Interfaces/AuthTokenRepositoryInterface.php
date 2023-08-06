<?php

namespace App\Commands\Interfaces;

use App\Responses\ReturnResponse;

interface AuthTokenRepositoryInterface
{
    public function createToken(string $email): array;
}
