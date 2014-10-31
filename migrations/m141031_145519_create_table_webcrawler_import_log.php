<?php

use yii\db\Migration;

class m141031_145519_create_table_webcrawler_import_log extends Migration {

    public function up() {
        $this->createTable('sc_webcrawler_import_log', array(
            'webcrawlerImportLogId' => 'pk',
            'webcrawlerId' => 'int not null',
            'articleId' => 'int',
            'executionTime' => 'timestamp not null default current_timestamp',
            'message' => 'text'));
        
        $this->addForeignKey('fk_sc_webcrawler_import_log_sc_webcrawler1', 'sc_webcrawler_import_log', 'webcrawlerId', 'sc_webcrawler', 'webcrawlerId');
        $this->addForeignKey('fk_sc_webcrawler_import_log_sc_article1', 'sc_webcrawler_import_log', 'articleId', 'sc_article', 'articleId');
    }

    public function down() {
        echo "m141031_145519_create_table_webcrawler_import_log cannot be reverted.\n";

        return false;
    }

}
