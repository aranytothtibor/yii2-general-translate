<?php

use yii\db\Migration;

/**
 * Class m190603_114430_TranslateModule
 */
class m190603_114430_TranslateModule extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        $this->createTable('language', [
            'lang_id' => $this->string(50)->notNull(),
            'parent_id' =>  $this->integer(),
            'name' => $this->string(100)->notNull(),
            'name_ascii' => $this->string(100)->notNull(),
            'status' => $this->boolean()->defaultValue(true),
            'PRIMARY KEY (lang_id)'
        ], $tableOptions);
        
        $this->createTable('translate_source', [
            'lang_id' => $this->string(50)->notNull(),
            'table_name' => $this->string()->notNull(),
            'source' => $this->integer()->notNull(),
            'row_id' => $this->integer()->notNull(),
        ]);
        
        $this->createIndex('idx-translate-parent_id', 'language', 'parent_id');
        $this->createIndex('idx-translate_source-lang_id', 'translate_source', 'lang_id');
        $this->createIndex('idx-translate_source-table_name', 'translate_source', 'table_name');
        $this->createIndex('idx-translate_source-row_id', 'translate_source', 'row_id');
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('translate_source');
        $this->dropTable('translate');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190603_114430_TranslateModule cannot be reverted.\n";

        return false;
    }
    */
}
