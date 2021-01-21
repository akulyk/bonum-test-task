<?php

$faker = Faker\Factory::create('en_US');
$count = Yii::$app->params['fixturesAmount'] ?? 100;
$clients  = [];

for ($i = 1;$i <= $count; $i++)
{
    $client = [
        'id' => $i,
        'name' => $faker->firstName() . ' ' . $faker->lastName,
    ];
    $clients[] = $client;
}

return $clients;
