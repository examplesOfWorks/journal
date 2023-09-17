<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\SubjectUser $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="subject-user-form">

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

    <?= $form->field($model, 'subject_name_id')->dropDownList($subjectNameList, ['prompt' => 'Выберите нужный предмет'])->label('') ?>

    <?= $form->field($model, 'user_id')->dropDownList($teacher, ['prompt' => 'Выберите преподавателя'])->label('') ?>

    <?= $form->field($model, 'group_id')->dropDownList($groupList, ['prompt' => 'Выберите группу'])->label('') ?>

    <div class="col-lg-11">
        <div class="d-flex justify-content-end">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
