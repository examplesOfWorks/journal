<?php

use yii\bootstrap5\Html;

/** @var yii\web\View $this */
/** @var app\models\SubjectUser $model */

$this->title = 'Назначить преподавателя';

?>
<div class="subject-user-create">

    <div class="section_title text-center">
        <div class="d-flex justify-content-center">
            <h3><?= Html::encode($this->title) ?></h3>
        </div>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
        'subjectNameList' => $subjectNameList,
        'teacher' => $teacher,
        'groupList' => $groupList
    ]) ?>

</div>
