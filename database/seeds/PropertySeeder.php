<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('properties')->insert([
            [
                'user_id' => 1,
                'name' => 'Property 1',
                'address' => 'Address 1',
                'description' => 'Description 1',
                'price' => 300,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'name' => 'Property 2',
                'address' => 'Address 2',
                'description' => 'Description 2',
                'price' => 500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'name' => 'Property 3',
                'address' => 'Address 3',
                'description' => 'Description 3',
                'price' => 1000,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
