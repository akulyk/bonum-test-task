<?php
namespace common\fixtures;

use yii\test\ActiveFixture;

class ClientFixture extends ActiveFixture
{
    public $modelClass = 'common\models\Client';
    public $dataFile = __DIR__.'/data/clients.php';
}
