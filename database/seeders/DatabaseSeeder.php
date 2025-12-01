<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AuthSeeder::class);

        \App\Models\Customer::factory(10)->create();
        \App\Models\Package::factory(5)->create();
        \App\Models\Inventory::factory(10)->create();
        
        // Create transactions with details
        \App\Models\Transaction::factory(20)->create()->each(function ($transaction) {
            \App\Models\TransactionDetail::factory(rand(1, 3))->create([
                'transaction_id' => $transaction->id,
            ]);
        });

        \App\Models\Finance::factory(10)->create();
        \App\Models\InventoryLog::factory(10)->create();
    }
}
