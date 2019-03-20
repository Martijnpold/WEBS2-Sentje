<?php

use Illuminate\Database\Seeder;

class PaymentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payments')->insert([
            'id' => 1,
            'payment_request_id' => 2,
            'name' => 'Martijn'
        ]);
        DB::table('payments')->insert([
            'id' => 2,
            'payment_request_id' => 2,
            'name' => 'Yoran'
        ]);
    }
}
