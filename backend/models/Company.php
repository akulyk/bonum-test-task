<?php
declare(strict_types=1);

namespace backend\models;


class Company extends \common\models\Company
{
    public array $clientIds = [];

    public function rules(): array
    {
        return [
            ['title', 'required'],
            ['title', 'string'],
            ['clientIds', 'each', 'rule' => ['integer']]
        ];
    }

    public function afterFind()
    {
        parent::afterFind();
        if ($clients = $this->clients) {
            foreach ($clients as $client) {
                $this->clientIds[] = $client->id;
            }
        }
    }

    public static function makeInitTextForSelect2ClientIds(array $clientIds = []): ?array
    {
        $initClients = null;
        if(!empty($clientIds)){
            $clients = Client::findAll(['id'=>$clientIds]);
            $initClients = [];
            foreach ($clients as $client){
                $initClients[$client->id] = $client->name;
            }
        }
        return $initClients;
    }
}
