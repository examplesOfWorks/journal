<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ParentStudent $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="parent-student-form">

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

    <?= $form->field($model, 'user_id')->dropDownList($fio, ['readOnly'=>true])->label('<span class="required">*</span>') ?>

    <?= $form->field($model, 'student_id')->dropDownList($studentList, ['prompt' => 'Выберите студента'])->label('<span class="required">*</span>') ?>

    <div class="col-lg-11">
        <div class="d-flex justify-content-end">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
