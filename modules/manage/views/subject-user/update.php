<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\SubjectUser $model */

$this->title = 'Редактировать запись: ' . $model->subjectName->title;

?>
<div class="container">
    <div class="subject-user-update">

        <h1><?= Html::encode($this->title) ?></h1>

        <?= $this->render('_form', [
            'model' => $model,
            'subjectNameList' => $subjectNameList,
            'teacher' => $teacher,
            'groupList' => $groupList
        ]) ?>

    </div>
</div>