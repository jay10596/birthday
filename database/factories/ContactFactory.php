<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Contact;
use App\User;
use Faker\Generator as Faker;

$factory->define(Contact::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'birthday' => '05/10/1996',
        'company' => $faker->company,
        'user_id' => factory(User::class)
    ];
});
