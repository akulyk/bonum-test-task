<?php
declare(strict_types=1);

namespace backend\models\search;


use backend\models\Company;

class CompanySearch extends Company
{
    public ?string $client = null;

    public function rules(): array
    {
        return [
            [['id', 'title', 'client'], 'trim'],
            ['id', 'integer'],
            [['title', 'client'], 'string'],
        ];
    }

}
