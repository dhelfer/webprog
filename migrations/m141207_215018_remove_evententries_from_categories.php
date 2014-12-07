<?php

use yii\db\Migration;

class m141207_215018_remove_evententries_from_categories extends Migration {

    public function up() {
        $this->execute('set foreign_key_checks = 0');
        $this->delete('sc_subcategory', ['categoryId' => 2]);
        $this->delete('sc_category', ['categoryId' => 2]);
        $this->execute('set foreign_key_checks = 1');
    }

    public function down() {
        echo "m141207_215018_remove_evententries_from_categories cannot be reverted.\n";

        return false;
    }

}
