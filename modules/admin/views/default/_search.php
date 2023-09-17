<?php

use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\OrganizationalInfoSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="organizational-info-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'organization_id')->dropdownList($organizations, ['prompt' => 'Выберите организацию']) ?>

    <div class="form-group">
        <?= Html::submitButton('Поиск', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Сброс', ['/admin/default/index'], ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
