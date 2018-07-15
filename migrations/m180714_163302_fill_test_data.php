<?php

use yii\db\Migration;

/**
 * Class m180714_163302_fill_test_data
 */
class m180714_163302_fill_test_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('{{%user}}', ['username' => 'from', 'created_at' => date(time())]);
        $this->insert('{{%user}}', ['username' => 'to', 'created_at' => date(time())]);
        $this->insert('{{%user}}', ['username' => 'fromBorder', 'created_at' => date(time())]);
        $this->insert('{{%user}}', ['username' => 'toBorder', 'created_at' => date(time())]);
        $this->insert('{{%user}}', ['username' => 'fromOutBorder', 'created_at' => date(time())]);
        $this->insert('{{%user}}', ['username' => 'toOutBorder', 'created_at' => date(time())]);
        
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('{{%user}}', 'username in ("from", "to", "fromBorder", "toBorder", "fromOutBorder", "toOutBorder") ');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180714_163302_fill_test_data cannot be reverted.\n";

        return false;
    }
    */
}
