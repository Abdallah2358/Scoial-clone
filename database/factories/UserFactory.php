<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Users::class, function (Faker $faker) {
    $gender_id = $faker->numberBetween(1, 2);

    return [
        'gender_id' => $gender_id ,
        'username' => $faker->username(),
        'first_name' => $gender_id == 1 ? $faker->firstNameMale() : $faker->firstNameFemale(),
        'last_name' => $faker->lastName(),
        'email' => $faker->unique()->safeEmail,
        'birth_date' =>$faker->date(),
        'adress' =>$faker->address(),
        'bio' => $faker->text($maxNbChars = 500),
        'password'=>"password",
    ];
});
