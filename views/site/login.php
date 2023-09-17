<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Авторизация';

?>
<div class="popular_program_area section__padding program__page">
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="col-lg-6">
                <div class="single__program">
                    <div class="program__content">
                        <div class="section_title text-center">
                            <div class="d-flex justify-content-center mb-4">
                                <h3><?= Html::encode($this->title) ?></h3>
                            </div>
                                <?php $form = ActiveForm::begin([
                                    'id' => 'login-form',
                                    'layout' => 'horizontal',
                                    'fieldConfig' => [
                                        'template' => "
                                            <div class=\"d-flex justify-content-center\">
                                                {input}
                                            </div>\n",
                                    ], 
                                ]); ?>

                                    <?= $form->field($model, 'login')->textInput(['autofocus' => true, 'placeholder' => 'Введите логин'])->label(false) ?>

                                    <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Введите пароль'])->label(false) ?>

                                        <?= Html::submitButton('Вход', ['class' => 'boxed-btn5', 'name' => 'login-button']) ?>

                                <?php ActiveForm::end(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>                        
    </div> 
</div>   


