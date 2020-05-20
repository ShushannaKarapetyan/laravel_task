<?php

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TenancySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('tenancies')->truncate();
        Schema::enableForeignKeyConstraints();

        $id = User::first()->id;

        DB::table('tenancies')->insert([
            [
                'user_id' => $id,
                'property_id' => 1,
                'tenant_id' => 2,
                'start_date' => new Carbon('2020-03-02 00:00:00'),
                'end_date' => new Carbon('2020-05-16 00:00:00'),
                'monthly_rent' => 300,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => $id,
                'property_id' => 2,
                'tenant_id' => 3,
                'start_date' => new Carbon('2020-03-08 00:00:00'),
                'end_date' => new Carbon('2020-05-29 00:00:00'),
                'monthly_rent' => 500,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => $id,
                'property_id' => 1,
                'tenant_id' => 1,
                'start_date' => new Carbon('2020-05-17 00:00:00'),
                'end_date' => new Carbon('2020-06-28 00:00:00'),
                'monthly_rent' => 300,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
