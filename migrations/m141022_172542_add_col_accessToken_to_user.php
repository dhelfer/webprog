<?php

use yii\db\Schema;
use yii\db\Migration;

class m141022_172542_add_col_accessToken_to_user extends Migration {
    public function up() {
        $this->addColumn('sc_user', 'accessToken', 'text');
    }

    public function down() {
        echo "m141022_172542_add_col_accessToken_to_user cannot be reverted.\n";

        return false;
    }
}
