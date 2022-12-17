<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $gender = $faker->randomElement(['male', 'female']);
        foreach (range(1,200) as $index) {
            DB::table('todo_tbl')->insert([
                'name' => $faker->name($gender),
                'list' => $faker->username
               
            ]);
        }
    }

    public function __construct() {
    }
}
