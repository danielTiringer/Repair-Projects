<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%status}}`.
 */
class m201024_183014_create_status_table extends Migration
{
    const TABLE_NAME = 'status';

    const LINKED_COLUMN = [
        'tableName' => 'project',
        'columnName' => 'status',
    ];

    const STATUSES = [
        'In Progress',
        'Done',
        'Scrapped',
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
                'status_description' => $this->string(255)->notNull(),
            ],
        );

        foreach (self::STATUSES as $status) {
            $this->insert(
                self::TABLE_NAME,
                ['status_description' => $status]
            );
        }

        $this->addColumn(
            self::LINKED_COLUMN['tableName'],
            self::LINKED_COLUMN['columnName'],
            $this->integer(11)->unsigned()->defaultValue(1)->after('source')
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
