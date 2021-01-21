<?php
declare(strict_types=1);

namespace backend\models\search;


use backend\models\Client;

class ClientSearch extends Client
{
    public ?string $company = null;

    public function rules(): array
    {
        return [
            [['id', 'name', 'company'], 'trim'],
            ['id', 'integer'],
            [['name', 'company'], 'string'],
        ];
    }

}
