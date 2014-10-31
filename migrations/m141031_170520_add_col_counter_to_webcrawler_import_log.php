<?php

use yii\db\Migration;

class m141031_170520_add_col_counter_to_webcrawler_import_log extends Migration {

    public function up() {
        $this->addColumn('sc_webcrawler_import_log', 'runNumber', 'int not null');
    }

    public function down() {
        echo "m141031_170520_add_col_counter_to_webcrawler_import_log cannot be reverted.\n";

        return false;
    }

}
