<?php

use Yii;
use yii\grid\GridView;
use yii\helpers\Html;
use app\models\Status;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Projects');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p><?= Html::a(Yii::t('app', 'Create Project'), ['create'], ['class' => 'btn btn-success']) ?></p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'make',
            'model',
            'description:ntext',
            'year',
            'source',
            [
                'class' => 'yii\grid\DataColumn',
                'attribute' => 'status',
                'format' => 'text',
                'filter' => (new Status())->getDescriptions(),
                'label' => Yii::t('app', 'Status'),
                'value' => function($model) {
                    $status = Status::find()->where(['id' => $model->status])->one();
                    return Yii::t('app', $status['status_description']);
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]) ?>
</div>
