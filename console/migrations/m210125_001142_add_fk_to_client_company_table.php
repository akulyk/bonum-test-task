<?php

use common\models\Client;
use common\models\ClientCompany;
use common\models\Company;
use yii\db\Migration;

/**
 * Class m210125_001142_add_fk_to_client_company_table
 */
class m210125_001142_add_fk_to_client_company_table extends Migration
{


    public function up()
    {
        $this->addForeignKey(
            'fk-client_company-client_id',
            ClientCompany::tableName(),
            'client_id',
            Client::tableName(),
            'id',
            'CASCADE',
            'NO ACTION'
        );
        $this->addForeignKey(
            'fk-client_company-company_id',
            ClientCompany::tableName(),
            'company_id',
            Company::tableName(),
            'id',
            'CASCADE',
            'NO ACTION'
        );
    }

    public function down()
    {
        $this->dropForeignKey('fk-client_company-client_id', ClientCompany::tableName());
        $this->dropForeignKey('fk-client_company-company_id', ClientCompany::tableName());
    }

}
