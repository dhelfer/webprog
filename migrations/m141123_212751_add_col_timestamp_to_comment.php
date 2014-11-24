<?php

use yii\db\Migration;

class m141123_212751_add_col_timestamp_to_comment extends Migration {

    public function up() {
        $this->addColumn('sc_comment', 'dateCreated', 'datetime not null default now()');
    }

    public function down() {
        echo "m141123_212751_add_col_timestamp_to_comment cannot be reverted.\n";

        return false;
    }

}
