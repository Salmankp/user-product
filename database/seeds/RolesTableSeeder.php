<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::enableForeignKeyConstraints();
        DB::table('roles')->insert([
                [
                    'name' => 'Admin',
                    'guard_name' =>'web',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'name' => 'Master User',
                    'guard_name' =>'web',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'name' => 'Child User',
                    'guard_name' =>'web',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]
            ]
        );
    }
}
