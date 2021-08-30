<?php

use App\Cryptocurrency;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CryptocurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Cryptocurrencies = [
            ['code' => 'BTC', 'name' => 'Bitcoin'],
            ['code' => 'ETH', 'name' => 'Ethereum'],
            ['code' => 'DOGE', 'name' => 'DogeCoin'],
        ];

        foreach($Cryptocurrencies as $crypto) {
            Cryptocurrency::firstOrCreate($crypto);
        }
    }
}
