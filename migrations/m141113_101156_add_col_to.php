<?php

use yii\db\Migration;

class m141113_101156_add_col_to extends Migration {

    public function up() {
        $this->addColumn('sc_webcrawler', 'specialMapping', 'text');
    }

    public function down() {
        echo "m141113_101156_add_col_to cannot be reverted.\n";

        return false;
    }

}
