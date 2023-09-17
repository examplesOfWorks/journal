<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\User $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n
                <div class=\"col-lg-10\">
                    {input}
                </div>\n",
            'labelOptions' => ['class' => 'col-sm-1 control-label text-sm-end pt-2'],  
        ], 
        
    ]); ?>

    <?= $form->field($model, 'role')->dropDownList($roleName, ['prompt' => 'Выберите роль'])->label('<span class="required">*</span>') ?>

    <?= $form->field($model, 'gender_id')->dropDownList($genders, ['prompt' => 'Выберите пол'])->label('<span class="required">*</span>') ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Введите имя'])->label('<span class="required">*</span>') ?>

    <?= $form->field($model, 'surname')->textInput(['maxlength' => true, 'placeholder' => 'Введите фамилию'])->label('<span class="required">*</span>') ?>

    <?= $form->field($model, 'patronymic')->textInput(['maxlength' => true,  'placeholder' => 'Введите отчество (при наличии)'])->label('<span class="col-sm-3 control-label text-sm-end pt-2"></span>') ?>

    <?= $form->field($model, 'login', ['enableAjaxValidation' => true])->textInput(['maxlength' => true, 'placeholder' => 'Введите логин'])->label('<span class="required">*</span>') ?>

    <?= $form->field($model, 'birthday')->textInput(['type' => 'date', 'placeholder' => 'Введите дату рождения'])->label('<span class="required">*</span>') ?>

    <?= $form->field($model, 'residential_address')->textInput(['maxlength' => true, 'placeholder' => 'Введите адрес проживания'])->label('<span class="required">*</span>') ?>

    <?= $form->field($model, 'registration_address')->textInput(['maxlength' => true, 'placeholder' => 'Введите адрес регистрации'])->label('<span class="required">*</span>') ?>

    <?= $form->field($model, 'email', ['enableAjaxValidation' => true])->textInput(['maxlength' => true, 'placeholder' => 'Введите адрес адрес электронной почты'])->label('<span class="required">*</span>') ?>

    <?= $form->field($model, 'phone', ['enableAjaxValidation' => true])->textInput(['maxlength' => true, 'placeholder' => 'Введите номер телефона'])->label('<span class="required">*</span>')  ?>


    <div class="col-lg-11">
        <div class="d-flex justify-content-end">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>




