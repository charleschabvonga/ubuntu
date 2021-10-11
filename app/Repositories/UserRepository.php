<?php

namespace App\Repositories;

use App\Enums\RoleType;
use App\Notifications\SignupActivate;
use App\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class UserRepository implements IRepository
{
    /**
     * Get all users.
     *
     * @return User[]|Collection
     */
    public function all(): Collection
    {
        $users = User::all();
        return $users;
    }

    /**
     * Save User
     *
     * @param $data
     * @return User
     */
    public function save(array $data): ?Model
    {
        $user = new User();
        $user = $user->fill($data);

        $user->save();

        return $user->refresh();
    }

    /**
     * @param string $email
     * @return mixed
     */
    public function findByEmail(string $email): ?User
    {
        return User::firstWhere('email', $email);
    }

    /**
     * @param Model $user
     * @param array $data
     * @return mixed
     */
    public function update(Model $user, array $data): ?Model
    {
        $user = $user->fill($data);
        $user->update();

        return $user->refresh();
    }

    /**
     * @param Model $user
     * @return mixed
     * @throws \Exception
     */
    public function delete(Model $user): ?bool
    {
        return $user->delete();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find(int $id): ?Model
    {
        return User::findOrFail($id);
    }
}
