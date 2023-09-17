<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ParentStudent $model */

$this->title = 'Отредактировать данные: ' . $model->id;

?>
<div class="parent-student-update">

    <div class="section_title text-center">
        <div class="d-flex justify-content-center">
            <h3><?= Html::encode($this->title) ?></h3>
        </div>
    </div>


    <?= $this->render('_form', [
        'model' => $model,
        'fio' => $fio
    ]) ?>

</div>
