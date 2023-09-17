<?php

use yii\bootstrap5\Html;
use yii\helpers\VarDumper;

/** @var yii\web\View $this */
/** @var app\models\Schedule $model */

$this->title = 'Внести новую запись в расписание';
?>
<div class="schedule-create">

    <div class="section_title text-center">
        <div class="d-flex justify-content-center">
            <h3><?= Html::encode($this->title) ?></h3>
        </div>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
        'subject_user' => $subject_user
    ]) ?>

</div>
