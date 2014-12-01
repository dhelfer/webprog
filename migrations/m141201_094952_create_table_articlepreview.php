<?php

use yii\db\Migration;

class m141201_094952_create_table_articlepreview extends Migration {

    public function up() {
        $this->createTable('sc_article_preview', [
            'articlePreviewId' => 'int not null auto_increment primary key',
            'title' => 'text',
            'article' => 'longtext',
            'userId' => 'int not null',
            'dateCreated' => 'datetime not null default now()',
        ]);
        $this->addForeignKey('sc_article_preview_sc_user1', 'sc_article_preview', 'userId', 'sc_user', 'userId');
    }

    public function down() {
        echo "m141201_094952_create_table_articlepreview cannot be reverted.\n";

        return false;
    }

}
