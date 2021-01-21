<?php
namespace common\fixtures;

use yii\test\ActiveFixture;

class ClientCompanyFixture extends ActiveFixture
{
    public $modelClass = 'common\models\ClientCompany';
    public $dataFile = __DIR__.'/data/client_companies.php';
}
