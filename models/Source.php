<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "source".
 *
 * @property int $id
 * @property string $source_description
 *
 * @property Project[] $projects
 */
class Source extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'source';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['source_description'], 'required'],
            [['source_description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'source_description' => 'Description',
        ];
    }

    /**
    * Returns the status_description of every entry in the database
    *
    * @return array
    */
    public function getDescriptions()
    {
        return array_column(
            $this->find()->all(),
            'source_description',
            'id'
        );
    }


    /**
     * Gets query for [[Projects]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProjects()
    {
        return $this->hasMany(Project::class, ['source' => 'id']);
    }
}

