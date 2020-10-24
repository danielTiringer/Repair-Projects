<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m201023_120421_create_user_table extends Migration
{
	const TABLE_NAME = 'user';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		$this->createTable(
			self::TABLE_NAME,
			[
				'id' => $this->primaryKey(),
				'username' => $this->string(55)->notNull(),
				'email' => $this->string(255)->notNull(),
				'password' => $this->string(255)->notNull(),
				'auth_key' => $this->string(255)->notNull(),
				'access_token' => $this->string(255)->notNull(),
			]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
		$this->dropTable(
			self::TABLE_NAME
		);
    }
}
