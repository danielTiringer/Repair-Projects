<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Component */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Components'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="component-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'make',
            'model',
            'type',
            'code',
            'description:ntext',
            [
                'attribute' => 'source',
                'value' => $model->source0->source_description,
            ],
            [
                'attribute' => 'created_by',
                'value' => $model->createdBy->username,
            ],
            'created_at:datetime',
            [
                'attribute' => 'updated_by',
                'value' => $model->createdBy->username,
            ],
            'updated_at:datetime',
        ],
    ]) ?>

</div>
