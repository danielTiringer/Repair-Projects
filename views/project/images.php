<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Image;

/* @var $this yii\web\View */
/* @var $upload app\models\Image */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="images-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($upload, 'file[]')->fileInput(['multiple' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Upload'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

