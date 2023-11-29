<?php

use App\Models\User;
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
        User::create([
            'name' => 'Ivan',
            'email' => 'test@gmail.com',
            'password' => bcrypt('1234')
        ]);
    }
}
