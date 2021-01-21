<?php declare(strict_types=1);
namespace common\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * Client model
 *
 * @property integer $id
 * @property string $name
 * @property Company[] $companies
 */
class Client extends ActiveRecord
{

    public static function tableName(): string
    {
        return 'client';
    }

    public function getClientCompanies(): ActiveQuery
    {
        return $this->hasMany(ClientCompany::class,['client_id'=>'id']);
    }

    public function getCompanies(): ActiveQuery
    {
     return $this->hasMany(Company::class,['id'=>'company_id'])
     ->via('clientCompanies');
    }

    public function getCompanyNamesList($glue = '; '): string
    {
        $list = [];
        if($companies = $this->companies){
            foreach ($companies as $company){
                $list[] = $company->title;
            }
        }

        return !empty($list) ? implode($glue,$list) : '';
    }

}
