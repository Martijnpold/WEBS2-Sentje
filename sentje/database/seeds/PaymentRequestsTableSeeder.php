<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PaymentRequestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_requests')->insert([
            'id' => 1,
            'payment_account_id' => 1,
            'description' => 'Van die ene keer toen we naar de club gingen',
            'amount' => 26.40,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('payment_requests')->insert([
            'id' => 2,
            'payment_account_id' => 1,
            'description' => 'Eten',
            'amount' => 100.00,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        
        DB::table('payment_requests')->insert([
            'id' => 3,
            'payment_account_id' => 2,
            'description' => 'Van een andere user',
            'amount' => 30.00,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
