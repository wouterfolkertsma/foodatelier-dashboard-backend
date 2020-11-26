<?php

namespace App\Traits;

use App\Http\Requests\StoreUser;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * Trait GeneratesLinks
 *
 * @package App\Traits
 */
trait CreatesUsers
{
    /**
     * @param  array  $data
     *
     * @return array
     */
    protected function splitData(array $data): array
    {
        $userKeys = array_keys(StoreUser::rules());

        $userData = Arr::only($data, $userKeys);
        $profileData = Arr::except($data, $userKeys);

        if (isset($data['password'])) {
            $userData['password'] = $data['password'];
        }

        return [$userData, $profileData];
    }

    /**
     * @param  array  $data
     * @param  int  $profileId
     *
     * @return bool
     */
    protected function createNewUser(array $data, int $profileId) : bool
    {
        $user = $this->user->newInstance();
        $password = isset($data['password']) ? $data['password'] : Str::random(40);

        $user->fill(array_merge($data, [
            'profile_type' => $this->getType(),
            'profile_id' => $profileId,
            'password' => Hash::make($password)
        ]))->save();

        // TODO: Make email template etc working
//        $user->notify(new CreatePassword($user, $password));

        return $user !== null;
    }

    /**
     * @return mixed
     */
    abstract protected function getType();
}