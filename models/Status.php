<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Query;

/**
 * This is the model class for table "status".
 *
 * @property int $id
 * @property string description
 *
 * @property Project[] $projects
 */
class Status extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status_description'], 'required'],
            [['status_description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'status_description' => Yii::t('app', 'Description'),
        ];
    }

	/**
	 * Returns the status_description of every entry in the database
	 *
	 * @return array
	 */
	public function getDescriptions()
	{
		return array_map(function($status) {
			return Yii::t('app', $status);
		}, array_column(
			$this->find()->all(),
			'status_description',
			'id'
		));
	}

    /**
     * Gets query for [[Projects]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProjects()
    {
        return $this->hasMany(Project::className(), ['status' => 'id']);
    }
}

