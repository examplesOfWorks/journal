<?php

use yii\bootstrap5\Html;

/** @var yii\web\View $this */
/** @var app\models\User $model */

$this->title = 'Добавление нового пользователя';

?>
<div class="user-create">

    <div class="section_title text-center">
        <div class="d-flex justify-content-center">
            <h3><?= Html::encode($this->title) ?></h3>
        </div>
        <p>Доступные роли: преподаватели, студенты, родители</p>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
        'roleName' => $roleName,
        'genders' => $genders,
    ]) ?>

</div>
