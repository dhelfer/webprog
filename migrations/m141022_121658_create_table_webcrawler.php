<?php

use yii\db\Schema;
use yii\db\Migration;

class m141022_121658_create_table_webcrawler extends Migration {
    public function up() {
        $this->addColumn('sc_article', 'realeased', 'tinyint(1)');
        
        $this->createTable('sc_webcrawler', array(
            'webcrawlerId' => 'pk',
            'link' => 'text not null',
            'categoryId' => 'int not null'));
        $this->addForeignKey('fk_sc_webcrawler_sc_category1', 'sc_webcrawler', 'categoryId', 'sc_category', 'categoryId');
    }

    public function down() {
        echo "m141022_121658_create_table_webcrawler cannot be reverted.\n";

        return false;
    }
}
