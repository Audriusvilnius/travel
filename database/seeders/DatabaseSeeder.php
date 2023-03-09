<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('123'),
            'role'=>'manager'
        ]);
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123'),
            'role'=>'admin'
        ]);
            DB::table('users')->insert([
            'name' => 'Customer',
            'email' => 'customer@gmail.com',
            'password' => Hash::make('123'),
            'role'=>'customer'
        ]);

        $faker = Faker::create();
        foreach (range(1,30) as $_) {
            DB::table('hotels')->insert([
            'title' => $faker->company.' Hotel',
        ]);}

        foreach(range(1, 102) as $_) {
            $mount=rand(1,12);
            $date = Carbon::create(2023, $mount, 01, 0, 0, 0);
            $start=$date->format('Y-m-d H:i:s');
            $week=rand(6, 52);
            $end=$date->addWeeks($week)->format('Y-m-d H:i:s');
            $lenght=rand(5, 14);
            $temp= Carbon::parse($start);
            $book=$temp->addWeeks(rand(1,$week))->format('Y-m-d H:i:s');
            $checko=Carbon::parse($book);
            $checkout=$checko->addDays($lenght);
            $photo=rand(1,21);

            DB::table('countries')->insert([
                'hotel_id' => rand(1,30),
                'title' => $faker->country,
                'city' => $faker->city,
                'lenght' => $lenght,
                'start'  => $start,
                'end'  => $end,
                'bookDate'=>$book,
                'checkout'=>$checkout,
                'price' => rand(49999, 139999) / 100,
                'photo' => '/images/temp/'.$photo.'.jpg',
                'des' => $faker->paragraph($nbSentences = rand(50, 100), $variableNbSentences = true)
            ]);
        }
    }
}