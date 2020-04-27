<?php

use App\Tenant;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tenant::truncate();

        DB::table('tenants')->insert([
            [
                'user_id' => 1,
                'name' => 'Tenant 1',
                'phone' => '0123456789',
                'image' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 1,
                'name' => 'Tenant 2',
                'phone' => '0123456789',
                'image' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 1,
                'name' => 'Tenant 3',
                'phone' => '0123456789',
                'image' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
