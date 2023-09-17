<?php

use yii\bootstrap5\Html;
use yii\helpers\VarDumper;

/** @var yii\web\View $this */
/** @var app\models\ParentStudent $model */

$this->title = 'Указать детей';

// VarDumper::dump($studentList, 10, true); die;

?>
<div class="parent-student-create">

    <div class="section_title text-center">
        <div class="d-flex justify-content-center">
            <h3><?= Html::encode($this->title) ?></h3>
        </div>
    </div>


    <?= $this->render('_form', [
        'model' => $model,
        'fio' => $fio,
        'studentList' => $studentList
    ]) ?>

</div>
