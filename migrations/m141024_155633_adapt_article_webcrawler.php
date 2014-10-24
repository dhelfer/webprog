<?php

use yii\db\Schema;
use yii\db\Migration;

class m141024_155633_adapt_article_webcrawler extends Migration {

    public function up() {
        $this->addColumn('sc_article', 'categoryId', 'int');
        $this->addColumn('sc_webcrawler', 'subCategoryId', 'int');
        
        $this->alterColumn('sc_article', 'subCategoryId', 'int');
        $this->alterColumn('sc_webcrawler', 'categoryId', 'int');
        
        $this->addForeignKey('fk_sc_article_sc_category1', 'sc_article', 'categoryId', 'sc_category', 'categoryId');
        $this->addForeignKey('fk_sc_webcrawler_sc_subcategory1', 'sc_webcrawler', 'subCategoryId', 'sc_subcategory', 'subCategoryId');
    }

    public function down() {
        echo "m141024_155633_adapt_article_webcrawler cannot be reverted.\n";

        return false;
    }

}
