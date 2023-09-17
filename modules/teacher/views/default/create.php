<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\SubjectUser $model */

$this->title = 'Create Subject User';
$this->params['breadcrumbs'][] = ['label' => 'Subject Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subject-user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
