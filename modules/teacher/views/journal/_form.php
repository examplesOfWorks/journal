<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Mark $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="mark-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'student_id')->textInput() ?>

    <?= $form->field($model, 'lesson_id')->textInput() ?>

    <?= $form->field($model, 'mark')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
