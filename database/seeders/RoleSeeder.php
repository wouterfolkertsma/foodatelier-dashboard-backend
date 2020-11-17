<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * @var string[]
     */
    public static $roles = ['Admin', 'Client'];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::$roles as $role) {
            Role::factory()->create([
                'name' => $role,
            ]);
        }
    }
}