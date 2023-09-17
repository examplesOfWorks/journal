<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Mark $model */

$this->title = 'Update Mark: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Marks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mark-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formMark', [
        'model' => $model,
    ]) ?>

</div>
