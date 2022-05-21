<?php

use App\User;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;


class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        User::create([
            'name'          => 'Saso Prati',
            'email'         => 'esseppi@tutanota.com',
            'password'      => Hash::make('asdasd'),
        ]);

        for ($i = 0; $i < 10; $i++) {
            $name = $faker->lastName();
            User::create([
                'name'          => $name,
                'email'         => $faker->email(),
                'password'      => Hash::make('asdasd'),
            ]);
        }
    }
}
