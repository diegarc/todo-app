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
        DB::table('users')->insert([
            'name' => 'Diego García',
            'email' => 'diegarc@gmail.com',
            'password' => bcrypt('secret'),
        ]);
    }
}
