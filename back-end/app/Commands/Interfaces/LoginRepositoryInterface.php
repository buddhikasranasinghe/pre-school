<?php

namespace App\Commands\Interfaces;

use App\DTO\UserDTO;

interface LoginRepositoryInterface
{
    public function login(UserDTO $credentials): ?UserDTO;
}
