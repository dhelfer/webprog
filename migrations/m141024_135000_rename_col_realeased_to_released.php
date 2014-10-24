<?php

use yii\db\Schema;
use yii\db\Migration;

class m141024_135000_rename_col_realeased_to_released extends Migration {

    public function up() {
        $this->renameColumn('sc_article', 'realeased', 'released');
    }

    public function down() {
        echo "m141024_135000_rename_col_realeased_to_released cannot be reverted.\n";

        return false;
    }

}
