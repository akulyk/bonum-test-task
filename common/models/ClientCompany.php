<?php declare(strict_types=1);
namespace common\models;

use yii\db\ActiveRecord;

/**
 * ClientCompany model
 *
 * @property integer $client_id
 * @property integer $company_id
 *
 */
class ClientCompany extends ActiveRecord
{

    public static function tableName()
    {
        return 'client_company';
    }
}
