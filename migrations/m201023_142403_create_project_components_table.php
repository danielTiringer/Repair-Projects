<?php

use yii\db\Migration;

/**
* Handles the creation of table `{{%project_components}}`.
*/
class m201023_142403_create_project_components_table extends Migration
{
    const TABLE_NAME = 'project_components';

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
                self::LINKED_COLUMNS[0]['name'] => $this->integer(11)->unsigned()->notNull(),
                self::LINKED_COLUMNS[1]['name'] => $this->integer(11)->unsigned()->notNull(),
                'source' => $this->string(255)->notNull(),
                'count' => $this->smallInteger(4)->unsigned()->notNull()->defaultValue(1),
                'price' => $this->integer(6)->unsigned()->notNull(),
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
