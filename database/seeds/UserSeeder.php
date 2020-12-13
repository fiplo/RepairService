<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password123'),
            'type' => 'Admin',
        ]);
        $user->personaldetails()->create([
            'name' => $user->name,
            'PhoneNumber' => '420',
        ]);

    }
}
