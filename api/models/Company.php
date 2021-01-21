<?php declare(strict_types=1);
namespace api\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

class Company extends \common\models\Company
{
    public function fields(): array
    {
        return ['id','title','clients'];
    }
}
