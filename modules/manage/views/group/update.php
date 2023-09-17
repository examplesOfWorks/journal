<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Group $model */

$this->title = 'Редактировать данные о названии группы: ' . $model->title;

?>
<div class="container">
    <div class="group-update">

        <h1><?= Html::encode($this->title) ?></h1>

        <?= $this->render('_form', [
            'model' => $model,
            'specialtyList' => $specialtyList
        ]) ?>

    </div>
</div>