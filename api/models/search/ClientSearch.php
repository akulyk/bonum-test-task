<?php declare(strict_types=1);

namespace api\models\search;

use common\models\Client;

class ClientSearch extends Client
{
    public ?string $company = null;
    public ?int $company_id = null;

    public function rules(): array
    {
        return [
            [['id','name','company'],'trim'],
            [['id','company_id'], 'integer'],
            [['name', 'company'], 'string'],
        ];
    }

}
