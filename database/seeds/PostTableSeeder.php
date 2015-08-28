<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class PostTableSeeder extends Seeder {

    public function run()
    {
        DB::table('posts')->truncate();     // clear data in table
        $faker = Faker\Factory::create();
        for ( $i=1; $i<=10; $i++ ) {
            $post = [
                    'title'     => $faker->text(rand(67, 77)),
                    'image'   => $faker->text(rand(167, 177)),
                    'short_description'   => $faker->text(rand(1167, 2077)),
                    'full_description' => $faker->text(rand(10167, 11077)),
                    'created_at'   => $faker->dateTime($max = 'now'),
                ];
            $posts[] = $post;
        }

        DB::table('posts')->insert($posts);

    }

}