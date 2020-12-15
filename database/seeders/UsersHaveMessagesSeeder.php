<?php

namespace Database\Seeders;

use App\Models\Dashboard;
use App\Models\Data\Data;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersHaveMessagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::all()->each(function ($user1) {
            User::all()->each(function ($user) use ($user1) {
                if ($user1->id !== $user->id) {
                    for ($i = 0; $i < 5; $i++) {
                        DB::table('users_messages')->insert([
                            [
                                'user_id_from' => $user1->id,
                                'user_id_to' => $user->id,
                                'message_id' => rand(1, 250)
                            ],
                        ]);
                    }
                }
            });
        });
    }
}