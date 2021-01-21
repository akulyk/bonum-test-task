<?php

use common\models\User;
use yii\db\Migration;

/**
 * Class m210121_200412_user_table_fixes
 */
class m210121_200412_user_table_fixes extends Migration
{

    public function up()
    {
        $this->alterColumn(User::tableName(),'username',$this->string()->null());
        $this->addColumn(User::tableName(),'token_expiration_time',$this->integer());
    }

    public function down()
    {
        $this->dropColumn(User::tableName(),'token_expiration_time');
        $this->alterColumn(User::tableName(),'username',$this->string()->notNull());
    }

}
