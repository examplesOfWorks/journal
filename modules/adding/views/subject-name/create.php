<?php

use yii\bootstrap5\Html;

/** @var yii\web\View $this */
/** @var app\models\SubjectName $model */

$this->title = 'Добавить новый предмет';

?>
<div class="subject-name-create">

    <div class="section_title text-center">
        <div class="d-flex justify-content-center">
            <h3><?= Html::encode($this->title) ?></h3>
        </div>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
