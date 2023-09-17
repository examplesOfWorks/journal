<?php

use yii\bootstrap5\Html;

/** @var yii\web\View $this */
/** @var app\models\Student $model */

$this->title = 'Прикрепить студента к группе';

?>
<div class="container">
    <div class="student-create">

        <div class="section_title text-center">
            <div class="d-flex justify-content-center">
                <h3><?= Html::encode($this->title) ?></h3>
            </div>
            <?= (Yii::$app->user->identity->getRoles(Yii::$app->user->identity->id) ==  'Заведующий отделением') ?
                '<p> Группы отделения: ' . $myDepartment . '</p>' : ''?>
        </div>

        <?= $this->render('_form', [
            'model' => $model,
            'studentList' => $studentList,
            'groupList' => $groupList
        ]) ?>

    </div>
</div>