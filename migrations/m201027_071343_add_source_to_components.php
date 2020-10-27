<?php

use yii\db\Migration;

/**
 * Class m201027_071343_add_source_to_components
 */
class m201027_071343_add_source_to_components extends Migration
{
    const TABLE_NAME = 'component';
    const COLUMN_NAME = 'source';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(
            self::TABLE_NAME,
            self::COLUMN_NAME,
            $this->integer(11)->unsigned()->after('description')
        );

        $this->addForeignKey(
            'fk_' . self::TABLE_NAME . '_' . self::COLUMN_NAME,
            self::TABLE_NAME,
            self::COLUMN_NAME,
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
            'fk_' . self::TABLE_NAME . '_' . self::COLUMN_NAME,
            self::TABLE_NAME,
        );

        $this->dropColumn(
            self::TABLE_NAME,
            self::COLUMN_NAME
        );
    }
}
