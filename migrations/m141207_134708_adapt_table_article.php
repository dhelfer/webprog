<?php

use yii\db\Migration;

class m141207_134708_adapt_table_article extends Migration {

    public function up() {
        $this->alterColumn('sc_article', 'title', 'text not null');
        $this->alterColumn('sc_article', 'article', 'longtext not null');
        $this->alterColumn('sc_article', 'released', 'tinyint not null default 0');
        
        $this->alterColumn('sc_article_preview', 'title', 'text not null');
        $this->alterColumn('sc_article_preview', 'article', 'longtext not null');
    }

    public function down() {
        echo "m141207_134708_adapt_table_article cannot be reverted.\n";

        return false;
    }

}
