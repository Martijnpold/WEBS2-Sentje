<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

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
            'name' => encrypt('Martijn'),
            'paid' => false,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        
        DB::table('payments')->insert([
            'id' => 2,
            'payment_request_id' => 2,
            'name' => encrypt('Yoran'),
            'paid' => true,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
