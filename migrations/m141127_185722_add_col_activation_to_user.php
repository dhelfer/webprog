<?php

use yii\db\Migration;

class m141127_185722_add_col_activation_to_user extends Migration {

    public function up() {
        $this->addColumn('sc_user', 'activationKey', 'varchar(128)');
        $this->addColumn('sc_user', 'active', 'tinyint(1)');
        $this->alterColumn('sc_user', 'password', 'varchar(128) not null');
    }

    public function down() {
        echo "m141127_185722_add_col_activation_to_user cannot be reverted.\n";

        return false;
    }

}
