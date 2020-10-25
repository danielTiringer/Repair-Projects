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
            [['description'], 'required'],
            [['description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

	/**
	 * Returns the status_description of every entry in the database
	 *
	 * @return array
	 */
	public function getDescriptions()
	{
		$statuses = (new Query())
			->select('status_description')
			->from($this->tableName())
			->all();
		$pairedStatuses = [];
		foreach ($statuses as $key => $status) {
			$pairedStatuses[$key + 1] = Yii::t('app', $status['status_description']);
		}
		return $pairedStatuses;
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

