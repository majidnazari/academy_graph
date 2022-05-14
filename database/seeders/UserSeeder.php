<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now=Carbon::now();
        //
       DB::table('users')->insert([

        // "email" => "majidnazarister@gmail.com",
        //"type" =>"admin",
       [ "password" => Hash::make("12345"),
        "first_name" => "majid",
        "last_name" => "nazari",
        "email" => "09372120890",
        "created_at" => $now,
        "updated_at" =>$now
       ],
       [ "password" => Hash::make("123456"),
        "first_name" => "hashem",
        "last_name" => "beigi",
        "email" => "09372120891",
        "created_at" =>$now,
        "updated_at" =>$now
       ],
       [ "password" => Hash::make("123456"),
        "first_name" => "rasol",
        "last_name" => "mokhtar",
        "email" => "09372120892",
        "created_at" =>$now,
        "updated_at" =>$now
       ],
       [ "password" => Hash::make("123456"),
        "first_name" => "mahla",
        "last_name" => "soroush",
        "email" => "09372120893",
        "created_at" =>$now,
        "updated_at" =>$now
       ],
       [ "password" => Hash::make("123456"),
        "first_name" => "bagher",
        "last_name" => "mirsamie",
        "email" => "09372120894",
        "created_at" =>$now,
        "updated_at" =>$now
       ],


       ]);
    }
}
