<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Group $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="group-form">

    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n
                <div class=\"col-lg-10\">
                    {input}
                </div>\n
                ",
            'labelOptions' => ['class' => 'col-sm-1 control-label text-sm-end pt-2'], 
        ]
    ]); ?>

    <?= $form->field($model, 'specialty_id')->dropDownList($specialtyList, ['prompt' => 'Выберите нужную специальность'])->label('') ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true, 'placeholder' => 'Введите название группы'])->label('<span class="required">*</span>') ?>

    <div class="col-lg-11">
        <div class="d-flex justify-content-end">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
