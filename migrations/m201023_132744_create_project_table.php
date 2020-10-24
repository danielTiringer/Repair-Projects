<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%project}}`.
 */
class m201023_132744_create_project_table extends Migration
{
	const TABLE_NAME = 'project';

	const INDEXED_COLUMN = 'make';

	const LINKED_COLUMNS = [
		'created_by',
		'updated_by',
	];

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		$this->createTable(
			self::TABLE_NAME,
			[
				'id' => $this->primaryKey()->unsigned(),
				self::INDEXED_COLUMN => $this->string(50)->notNull(),
				'model' => $this->string(255)->notNull(),
				'year' => $this->integer(4)->notNull(),
				'code' => $this->string(50),
				'description' => $this->text(),
				'price' => $this->integer(6)->notNull(),
				'source' => $this->string(255)->notNull(),
				self::LINKED_COLUMNS[0] => $this->integer(11),
				'created_at' => $this->integer(11),
				self::LINKED_COLUMNS[1] => $this->integer(11),
				'updated_at' => $this->integer(11),
			]
		);

		$this->createIndex(
			'idx_' . self::TABLE_NAME . '_' . self::INDEXED_COLUMN,
			self::TABLE_NAME,
			self::INDEXED_COLUMN
		);

		foreach (self::LINKED_COLUMNS as $column) {
			$this->addForeignKey(
				'fk_' . self::TABLE_NAME . '_' . $column,
				self::TABLE_NAME,
				$column,
				'user',
				'id',
				'NO ACTION',
				'NO ACTION'
			);
		}
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
