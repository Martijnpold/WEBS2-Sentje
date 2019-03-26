<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PaymentAccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_accounts')->insert([
            'id' => 1,
            'user_id' => 1,
            'name' => 'Dinner',
            'balance' => 25.50,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        
        DB::table('payment_accounts')->insert([
            'id' => 2,
            'user_id' => 2,
            'name' => 'Sport',
            'balance' => 65.00,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        
        DB::table('payment_accounts')->insert([
            'id' => 3,
            'user_id' => 1,
            'name' => 'Advance Payments',
            'balance' => 30.00,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
