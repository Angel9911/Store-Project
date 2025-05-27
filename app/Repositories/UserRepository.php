<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    public function createUser(string $name, string $email, string $password): User
    {
        $data['name'] = $name;
        $data['email'] = $email;
        $data['password'] = Hash::make($password);
        return User::create($data);
    }

    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    public function findById(int $id): ?User
    {
        return User::find($id);
    }

    public function getAll(): \Illuminate\Database\Eloquent\Collection
    {
        return User::all();
    }

    public function delete(int $id): bool
    {
        return User::destroy($id) > 0;
    }

    public function updateUser(User $user, array $data): bool
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        return $user->update($data);
    }
}
