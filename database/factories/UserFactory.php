<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\User;
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

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => 'Admino Bosso',
        'email' => 'admin@admin.com',
        'email_verified_at' => now(),
        'password' => '$2y$10$z0D4xqaIt/XPlX59ceZYg.f0LZVvpw1EhP8B9epxwGlA0eecf8Jp.', // password
        // 'remember_token' => Str::random(10),
    ];
});
