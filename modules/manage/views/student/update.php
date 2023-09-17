<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Student $model */

$this->title = 'Редактировать запись';

?>

<div class="container">
    <div class="student-update">

        <h1><?= Html::encode($this->title) ?></h1>

        <?= $this->render('_form', [
            'model' => $model,
            'studentList' => $studentList,
            'groupList' => $groupList,
            'myDepartment' => $myDepartment
        ]) ?>

    </div>
</div>