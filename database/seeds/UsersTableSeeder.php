<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class)->create([
            'name' => 'Administrador',
            'email' => 'admin@example.com'
        ]);

        //TODO: create fake users
    }
}
