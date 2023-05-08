<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Carbon\Carbon;

class ProductSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        for($i=0;$i < 20; $i++){
            Product::create([
                'price' => rand(1000,10000),
                'discount' => rand(1,99) ,
                'offer_start' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-04-29 11:53:20')->addDays($i),
                'offer_end' => Carbon::createFromFormat('Y-m-d H:i:s', '2023-05-03 11:53:20')->addDays($i),
            ]);
        }
    }
}
