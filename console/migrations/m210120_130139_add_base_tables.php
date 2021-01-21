<?php

use common\models\Client;
use common\models\ClientCompany;
use common\models\Company;
use yii\db\Migration;

/**
 * Class m210120_130139_add_base_tables
 */
class m210120_130139_add_base_tables extends Migration
{

    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        $this->createTable(Client::tableName(), [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
        ], $tableOptions);
        $this->createTable(Company::tableName(), [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
        ], $tableOptions);
        $this->createTable(ClientCompany::tableName(), [
            'client_id' => $this->integer(),
            'company_id' => $this->integer(),
        ], $tableOptions);

        $this->createIndex('idx-client_company-client_id',ClientCompany::tableName(),'client_id');
        $this->createIndex('idx-client_company-company_id',ClientCompany::tableName(),'company_id');

    }

    public function down()
    {
        $this->dropIndex('idx-client_company-client_id',ClientCompany::tableName());
        $this->dropIndex('idx-client_company-company_id',ClientCompany::tableName());
        $this->dropTable(ClientCompany::tableName());
        $this->dropTable(Company::tableName());
        $this->dropTable(Client::tableName());
    }

}
