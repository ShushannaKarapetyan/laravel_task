<?php

use App\User;
use Carbon\Carbon;
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
        Schema::disableForeignKeyConstraints();
        DB::table('properties')->truncate();
        Schema::enableForeignKeyConstraints();

        $id = User::first()->id;

        DB::table('properties')->insert([
            [
                'user_id' => $id,
                'name_en' => 'Property 1',
                'name_ru' => 'Свойство 1',
                'address' => 'Address 1',
                'description_en' => "Some quick example text to build on the card title and make up the bulk of the card's content.",
                'description_ru' => 'Несколько быстрых примеров текста, основанного на названии карты и составляющего основную часть содержимого карты.',
                'price' => 300,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => $id,
                'name_en' => 'Property 2',
                'name_ru' => 'Свойство 2',
                'address' => 'Address 2',
                'description' => "Some quick example text to build on the card title and make up the bulk of the card's content.",
                'description_ru' => 'Несколько быстрых примеров текста, основанного на названии карты и составляющего основную часть содержимого карты.',
                'price' => 500,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => $id,
                'name_en' => 'Property 3',
                'name_ru' => 'Свойство 3',
                'address' => 'Address 3',
                'description' => "Some quick example text to build on the card title and make up the bulk of the card's content.",
                'description_ru' => 'Несколько быстрых примеров текста, основанного на названии карты и составляющего основную часть содержимого карты.',
                'price' => 1000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
