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
            'id' => 1,
            'name' => 'tinus',
            'email' => 'tinus@gmail.com',
            'password' => bcrypt('kip'),
        ]);
        DB::table('users')->insert([
            'id' => 2,
            'name' => 'CJ',
            'email' => 'lancaster.mmxv@gmail.com',
            'password' => bcrypt('kip'),
        ]);
    }
}
