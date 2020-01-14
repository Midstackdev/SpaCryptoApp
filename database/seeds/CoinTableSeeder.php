<?php

use App\Models\Coin;
use Illuminate\Database\Seeder;

class CoinTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $coins = [

        	[
        		'identifier' => 'tltc'
        	],

        	[
        		'identifier' => 'tbtc'
        	],

        	[
        		'identifier' => 'tbch'
        	],
        ];

        Coin::insert($coins);
    }
}
