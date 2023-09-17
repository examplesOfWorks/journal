<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Schedule $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="schedule-form">

    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n
                <div class=\"col-lg-10\">
                    {input}
                </div>\n
                ",
            'labelOptions' => ['class' => 'col-sm-1 control-label text-sm-end pt-2'],  
        ], 
    ]); ?>

    <?= $form->field($model, 'subject_user_id')->dropDownList($subject_user, ['prompt' => 'Выберите нужный урок'])->label('') ?>

    <?= $form->field($model, 'date')->textInput(['type' => 'date', 'placeholder' => 'Введите дату урока'])->label('<span class="required">*</span>') ?>

    <?= $form->field($model, 'lesson_number')->textInput(['placeholder' => 'Введите номер урока'])->label('<span class="required">*</span>') ?>

    <div class="col-lg-11">
        <div class="d-flex justify-content-end">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
