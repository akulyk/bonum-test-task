<?php declare(strict_types=1);
namespace common\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * Company model
 *
 * @property integer $id
 * @property string $title
 * @property Client[] $clients
 *
 */
class Company extends ActiveRecord
{

    public static function tableName(): string
    {
        return 'company';
    }

    public function getClientCompanies(): ActiveQuery
    {
        return $this->hasMany(ClientCompany::class,['company_id'=>'id']);
    }

    public function getClients(): ActiveQuery
    {
        return $this->hasMany(Client::class,['id'=>'client_id'])
            ->via('clientCompanies');
    }

    public function getClientNamesList($glue = '; '): string
    {
        $list = [];
        if($clients = $this->clients){
            foreach ($clients as $client){
                $list[] = $client->name;
            }
        }

        return !empty($list) ? implode($glue,$list) : '';
    }
}
