<?php

use yii\db\Migration;

/**
 * Class m180709_145826_db_init
 */
class m180709_145826_db_init extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [            
            'username' => $this->string()->notNull()->unique(),
            'balance' => $this->decimal(10, 2)->notNull()->defaultValue(0),
            'created_at' => $this->integer()->notNull(),         
            
        ], $tableOptions);
        
        $this->createTable('{{%transfers}}', [            
            'from' => $this->string()->notNull(),
            'to' => $this->string()->notNull(),
            'amount' => $this->decimal(10, 2)->unsigned()->notNull(),
            'date' => $this->integer()->notNull(),     
            'date' => $this->primaryKey(),
        ], $tableOptions);
    }
/**
 * {@inheritdoc}
 */
    public function down()
    {
        $this->dropTable('{{%user}}');
        $this->dropTable('{{%transfers}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180709_145826_db_init cannot be reverted.\n";

        return false;
    }
    */
}
