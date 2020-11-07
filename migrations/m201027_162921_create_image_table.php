<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%image}}`.
 */
class m201027_162921_create_image_table extends Migration
{
    const TABLE_NAME = 'image';

    const LINKED_COLUMNS = [
        [
            'name' => 'project_id',
            'linkedTable' => 'project',
        ],
        [
            'name' => 'component_id',
            'linkedTable' => 'component',
        ],
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
                self::LINKED_COLUMNS[0]['name'] => $this->integer(11)->unsigned(),
                self::LINKED_COLUMNS[1]['name'] => $this->integer(11)->unsigned(),
                'url' => $this->string(255)->notNull(),
                'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            ]
        );

        foreach (self::LINKED_COLUMNS as $column) {
            $this->addForeignKey(
                'fk_' . self::TABLE_NAME . '_' . $column['name'],
                self::TABLE_NAME,
                $column['name'],
                $column['linkedTable'],
                'id',
                'CASCADE',
                'CASCADE'
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
