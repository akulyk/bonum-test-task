<?php

$faker = $faker = Faker\Factory::create('en_US');
$count = Yii::$app->params['fixturesAmount'] ?? 100;
$companies  = [];

for ($i = 1;$i <= $count; $i++)
{
    $companies[] = [
      'id'=> $i,
      'title' => $faker->company
    ];
}

return $companies;
