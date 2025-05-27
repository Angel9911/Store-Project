<?php

namespace App\Services\Impl;

use App\Repositories\UserRepository;
use App\Services\UserService;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserServiceImpl implements UserService
{

    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login(string $email, string $password): bool
    {
        return Auth::attempt(['email' => $email, 'password' => $password]);
    }

    public function register(string $name, string $email, string $password): User
    {
        return $this->userRepository->createUser($name, $email, $password);
    }
}
