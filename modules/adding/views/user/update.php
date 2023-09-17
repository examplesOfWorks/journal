<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\User $model */

$this->title = 'Редактировать данные о пользователе: ' . $model->name;

?>
<div class="container">
    <div class="user-update">

        <h1><?= Html::encode($this->title) ?></h1>

        <?= $this->render('_formUpdate', [
            'model' => $model,
            'roleName' => $roleName,
                'genders' => $genders,
        ]) ?>

    </div>
</div>