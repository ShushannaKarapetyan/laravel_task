<?php

use App\User;
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
        Schema::disableForeignKeyConstraints();
        DB::table('tenants')->truncate();
        Schema::enableForeignKeyConstraints();

        $id = User::first()->id;

        DB::table('tenants')->insert([
            [
                'user_id' => $id,
                'name' => 'Tenant 1',
                'phone' => '0123456789',
                'image' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => $id,
                'name' => 'Tenant 2',
                'phone' => '0123456789',
                'image' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => $id,
                'name' => 'Tenant 3',
                'phone' => '0123456789',
                'image' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
