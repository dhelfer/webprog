<?php

use yii\db\Schema;
use yii\db\Migration;

class m141024_144721_insert_rss_user extends Migration {

    public function up() {
        $this->insert('sc_user', ['userId' => 9999, 'username' => 'SOLCITY_RSS_CRAWLER']);
    }

    public function down() {
        echo "m141024_144721_insert_rss_user cannot be reverted.\n";

        return false;
    }

}
