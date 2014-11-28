<?php

use yii\db\Migration;

class m141128_105204_make_username_and_email_unique extends Migration {

    public function up() {
        $this->createIndex('sc_user_userName_unique', 'sc_user', 'userName', true);
        $this->createIndex('sc_user_email_unique', 'sc_user', 'email', true);
        
        $this->alterColumn('sc_article', 'teaserImage', 'int');
        $this->addColumn('sc_user', 'passwordResetKey', 'varchar(128)');
    }

    public function down() {
        echo "m141128_105204_make_username_and_email_unique cannot be reverted.\n";

        return false;
    }

}
