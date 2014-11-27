<?php

use yii\db\Migration;

class m141127_201522_change_col_email_in_user extends Migration {

    public function up() {
        $this->alterColumn('sc_user', 'email', 'varchar(255) not null');
    }

    public function down() {
        echo "m141127_201522_change_col_email_in_user cannot be reverted.\n";

        return false;
    }

}
