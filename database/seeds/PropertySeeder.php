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
                'name_en' => 'Property 1',
                'name_ru' => 'Свойство 1',
                'address' => 'Address 1',
                'description_en' => 'Description 1',
                'description_ru' => 'Описание 1',
                'price' => 300,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'name_en' => 'Property 2',
                'name_ru' => 'Свойство 2',
                'address' => 'Address 2',
                'description' => 'Description 2',
                'description_ru' => 'Описание 2',
                'price' => 500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'name_en' => 'Property 3',
                'name_ru' => 'Свойство 3',
                'address' => 'Address 3',
                'description' => 'Description 3',
                'description_ru' => 'Описание 3',
                'price' => 1000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
