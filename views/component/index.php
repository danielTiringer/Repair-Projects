<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Source;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ComponentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Components');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="component-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Component'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'make',
            'model',
            'type',
            'code',
            'description:ntext',
            [
                'class' => 'yii\grid\DataColumn',
                'attribute' => 'source',
                'format' => 'text',
                'filter' => (new Source())->getDescriptions(),
                'label' => Yii::t('app', 'Source'),
                'value' => function($model) {
                    return $model->source0->source_description;
                }
            ],
            //'created_by',
            //'created_at',
            //'updated_by',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
