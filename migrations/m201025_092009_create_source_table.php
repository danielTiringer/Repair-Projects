<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%source}}`.
 */
class m201025_092009_create_source_table extends Migration
{
	const TABLE_NAME = 'source';

	const COLUMN_NAME = 'source_description';

	const LINKED_COLUMN = [
		'tableName' => 'project',
		'columnName' => 'source',
	];

	const SOURCES = [
		'Ebay',
		'Facebook',
		'Jofogas',
		'Vatera',
		'Other',
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
				self::COLUMN_NAME => $this->string(255)->notNull(),
			],
		);

		foreach (self::SOURCES as $source) {
			$this->insert(
				self::TABLE_NAME,
				[self::COLUMN_NAME => $source]
			);
		}

		$this->alterColumn(
			self::LINKED_COLUMN['tableName'],
			self::LINKED_COLUMN['columnName'],
			$this->integer(11)->unsigned()
		);

		$this->addForeignKey(
			'fk_' . self::LINKED_COLUMN['tableName'] . '_' . self::LINKED_COLUMN['columnName'],
			self::LINKED_COLUMN['tableName'],
			self::LINKED_COLUMN['columnName'],
			self::TABLE_NAME,
			'id',
			'NO ACTION',
			'NO ACTION'
		);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
		$this->dropForeignKey(
			'fk_' . self::LINKED_COLUMN['tableName'] . '_' . self::LINKED_COLUMN['columnName'],
			self::LINKED_COLUMN['tableName'],
		);

		$this->dropColumn(
			self::LINKED_COLUMN['tableName'],
			self::LINKED_COLUMN['columnName']
		);

		$this->dropTable(
			self::TABLE_NAME
		);
	}

}
