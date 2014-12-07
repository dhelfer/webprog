<?php

use yii\db\Migration;

class m141203_153854_add_fk_article_teaserimage extends Migration {

    public function up() {
        $this->addForeignKey('fk_sc_article_sc_image', 'sc_article', 'teaserImage', 'sc_image', 'imageId');
    }

    public function down() {
        echo "m141203_153854_add_fk_article_teaserimage cannot be reverted.\n";

        return false;
    }

}
