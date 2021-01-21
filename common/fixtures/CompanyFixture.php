<?php
namespace common\fixtures;

use yii\test\ActiveFixture;

class CompanyFixture extends ActiveFixture
{
    public $modelClass = 'common\models\Company';
    public $dataFile = __DIR__.'/data/companies.php';
}
