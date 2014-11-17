<?php

use yii\db\Migration;

class m141113_094334_update_table_article_for_feeds extends Migration {

    public function up() {
        $this->addColumn('sc_article', 'teaserImage', 'text');
        $this->addColumn('sc_article', 'dateCreated', 'datetime not null default NOW()');
        $this->addColumn('sc_article', 'dateLastUpdated', 'datetime not null default NOW() on update NOW()');
    }

    public function down() {
        echo "m141113_094334_update_table_article_for_feeds cannot be reverted.\n";

        return false;
    }

}
