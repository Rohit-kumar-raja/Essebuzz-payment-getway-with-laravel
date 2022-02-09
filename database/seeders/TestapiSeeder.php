<?php

namespace Database\Seeders;

use Carbon\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as faker;


class TestapiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('testapis')->insert([
'name'=>'Rohit kuamr',
'phone'=>'7250634942',
'email'=>'rohit83013@gmail.com',
'city'=>'jamshedpur',


        ]

        );
        }
}
