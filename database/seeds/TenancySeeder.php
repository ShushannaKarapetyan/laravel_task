<?php

use App\Tenancy;
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
        Tenancy::truncate();

        DB::table('tenancies')->insert([
            [
                'user_id' => 1,
                'property_id' => 1,
                'tenant_id' => 2,
                'start_date' => new Carbon('2020-03-02 00:00:00'),
                'end_date' => new Carbon('2020-05-16 00:00:00'),
                'monthly_rent' => 300,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 1,
                'property_id' => 2,
                'tenant_id' => 3,
                'start_date' => new Carbon('2020-03-08 00:00:00'),
                'end_date' => new Carbon('2020-05-29 00:00:00'),
                'monthly_rent' => 500,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 1,
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
