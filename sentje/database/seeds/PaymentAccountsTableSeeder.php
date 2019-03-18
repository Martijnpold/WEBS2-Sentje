<?php

use Illuminate\Database\Seeder;

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
            'owner_id' => 1,
            'name' => 'Dinner',
            'balance' => 25.50,
        ]);
        
        DB::table('payment_accounts')->insert([
            'id' => 2,
            'owner_id' => 2,
            'name' => 'Sport',
            'balance' => 65.00,
        ]);
        
        DB::table('payment_accounts')->insert([
            'id' => 3,
            'owner_id' => 1,
            'name' => 'Advance Payments',
            'balance' => 30.00,
        ]);
    }
}
