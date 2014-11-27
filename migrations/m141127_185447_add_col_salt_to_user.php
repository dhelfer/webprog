<?php

use yii\db\Migration;

class m141127_185447_add_col_salt_to_user extends Migration {

    public function up() {
        $this->addColumn('sc_user', 'salt', 'varchar(128) not null');
    }

    public function down() {
        echo "m141127_185447_add_col_salt_to_user cannot be reverted.\n";

        return false;
    }

}
