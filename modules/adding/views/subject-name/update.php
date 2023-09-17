<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\SubjectName $model */

$this->title = 'Редактировать данные о предмете: ' . $model->title;

?>
<div class="container">
    <div class="subject-name-update">

        <h1><?= Html::encode($this->title) ?></h1>

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>

    </div>
</div>