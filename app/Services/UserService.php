<?php

namespace App\Services;

use App\Models\User;

interface UserService
{
    public function login(string $email, string $password): bool;

    public function register(string $name, string $email, string $password): User;
}
