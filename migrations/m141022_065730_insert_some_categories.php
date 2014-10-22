<?php

use yii\db\Schema;
use yii\db\Migration;

class m141022_065730_insert_some_categories extends Migration {
    public function up() {
        $this->insert('sc_category', array('categoryId' => 1, 'name' => 'Essen & Trinken'));
        $this->insert('sc_category', array('categoryId' => 2, 'name' => 'Events'));
        $this->insert('sc_category', array('categoryId' => 3, 'name' => 'Business'));
        $this->insert('sc_category', array('categoryId' => 4, 'name' => 'News'));
        $this->insert('sc_category', array('categoryId' => 5, 'name' => 'Mehr'));
        
        $this->insert('sc_subcategory', array('categoryId' => 1, 'name' => 'Bier & Wein'));
        $this->insert('sc_subcategory', array('categoryId' => 1, 'name' => 'Restaurants'));
        $this->insert('sc_subcategory', array('categoryId' => 1, 'name' => 'Bars'));
        $this->insert('sc_subcategory', array('categoryId' => 2, 'name' => 'Kalender'));
        $this->insert('sc_subcategory', array('categoryId' => 2, 'name' => 'Konzerte'));
        $this->insert('sc_subcategory', array('categoryId' => 2, 'name' => 'Nightlife'));
        $this->insert('sc_subcategory', array('categoryId' => 5, 'name' => 'Sport'));
        $this->insert('sc_subcategory', array('categoryId' => 5, 'name' => 'Kunst'));
        $this->insert('sc_subcategory', array('categoryId' => 5, 'name' => 'Fotos'));
    }

    public function down() {
        echo "m141022_065730_insert_some_categories cannot be reverted.\n";

        return false;
    }
}
