<?php declare(strict_types=1);
namespace api\models;


class Client extends \common\models\Client
{
   public function fields(): array
   {
       return [
         'id','name','companies'
       ];
   }
}
