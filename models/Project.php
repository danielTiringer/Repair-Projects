<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "project".
 *
 * @property int $id
 * @property string $make
 * @property string $model
 * @property int $year
 * @property string|null $code
 * @property string|null $description
 * @property int $price
 * @property int|null $source
 * @property int|null $status
 * @property int|null $created_by
 * @property int|null $created_at
 * @property int|null $updated_by
 * @property int|null $updated_at
 *
 * @property Image[] $images
 * @property User $createdBy
 * @property Source $source0
 * @property Status $status0
 * @property User $updatedBy
 * @property ProjectComponents[] $projectComponents
 */
class Project extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            BlameableBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['make', 'model', 'year', 'price'], 'required'],
            [['year', 'price', 'source', 'status', 'created_by', 'created_at', 'updated_by', 'updated_at'], 'integer'],
            [['description'], 'string'],
            [['make', 'code'], 'string', 'max' => 50],
            [['model'], 'string', 'max' => 255],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
            [['source'], 'exist', 'skipOnError' => true, 'targetClass' => Source::class, 'targetAttribute' => ['source' => 'id']],
            [['status'], 'exist', 'skipOnError' => true, 'targetClass' => Status::class, 'targetAttribute' => ['status' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'make' => Yii::t('app', 'Make'),
            'model' => Yii::t('app', 'Model'),
            'year' => Yii::t('app', 'Year'),
            'code' => Yii::t('app', 'Code'),
            'description' => Yii::t('app', 'Description'),
            'price' => Yii::t('app', 'Price'),
            'source' => Yii::t('app', 'Source'),
            'status' => Yii::t('app', 'Status'),
            'images' => Yii::t('app', 'Images'),
            'created_by' => Yii::t('app', 'Created By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

   /**
    * Gets query for [[Source0]].
    *
    * @return ActiveQuery
    */
   public function getSource0()
   {
       return $this->hasOne(Source::class, ['id' => 'source']);
   }

    /**
    * Gets query for [[Status0]].
    *
    * @return ActiveQuery
    */
    public function getStatus0()
    {
    return $this->hasOne(Status::class, ['id' => 'status']);
    }

    /**
     * Gets query for [[Images]].
     *
     * @return ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(Image::class, ['project_id' => 'id']);
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    /**
     * Gets query for [[UpdatedBy]].
     *
     * @return ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }

    /**
     * Gets query for [[ProjectComponents]].
     *
     * @return ActiveQuery
     */
    public function getProjectComponents()
    {
        return $this->hasMany(ProjectComponents::class, ['project_id' => 'id']);
    }
}
