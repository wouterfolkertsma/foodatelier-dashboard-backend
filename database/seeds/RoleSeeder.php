<?php

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
            factory(App\Models\Role::class)->create([
                'name' => $role,
            ]);
        }
    }
}