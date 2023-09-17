<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Schedule $model */

$this->title = 'Редактировать запись в расписании о предмете: ' . $model->id;

?>
<div class="container">
    <div class="schedule-update">

        <h1><?= Html::encode($this->title) ?></h1>

        <?= $this->render('_form', [
            'model' => $model,
            'subject_user' => $subject_user
        ]) ?>

    </div>
</div>