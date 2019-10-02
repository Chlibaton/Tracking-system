<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\joforder;
use Faker\Generator as Faker;

$factory->define(joforder::class, function (Faker $faker) {
    return [
        'refno' => Str::random(10),
        'orderno' => Str::random(10),
        'jofno' => Str::random(10),
        'distributor_name' => $faker->name,
        'distributor_code' => Str::random(10),
        'customer_name' => $faker->name,
        'date_prepared' => '2019-10-1',
        'due_date' => '2019-10-17',
        'created_by' => 'jerald iglesia',
        'kind_of_ring' => 'Championship Ring',
        'metal' => '10KYG',
        'ring_size' => '13',
        'year' => '2019',
        'karat' => '10KYG',
        'text_style' => 'BLOCK',
        'stone' => 'FACET EMERALD',
        'weight' => '16 GRAMS',
        'oxidation' => 'OXI',
        'inside_engrave' => '01.08.1984',
        'left_shank' => 'ESTABLISHED',
        'top_shank' => 'SONS',
        'right_shank' => '35 YEARS',
        'attach_remarks' => 'SEE ATTACHMENT',
        'jof_status' => 'Receiving Section',

    ];
});
