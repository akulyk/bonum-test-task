<?php

declare(strict_types=1);

namespace api\tests\helpers;

use api\tests\fixtures\UserFixture;

final class FixtureHelper
{
    public const DIR = __DIR__ . '/../_data/';

    /**
     * @return array
     */
    public static function getAllFixtures(): array
    {
        return [
            'user' => [
                'class' => UserFixture::class,
                'dataFile' => self::DIR . 'user.php',
            ],
        ];
    }
}
