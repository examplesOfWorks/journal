<?php

use app\models\Schedule;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\VarDumper;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\ScheduleSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Моё расписание';
?>

<div class="schedule-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'ФИО преподавателя',
                'value' => function ($model) {
                    return $model->subjectUser->user->name . ' ' . 
                        $model->subjectUser->user->patronymic . ' ' . 
                        $model->subjectUser->user->surname;
                }
            ],
            [
                'label' => 'Наименование предмета',
                'value' => function ($model) {
                    return $model->subjectUser->subjectName->title;
                }
            ],
            [
                'label' => 'Группа',
                'value' => function ($model) {
                    return $model->subjectUser->group->title;
                }
            ],
            [
                'attribute' => 'date',
                'label' => 'Дата',
                'value' => 'date',
            ],
            [
                'attribute' => 'lesson_number',
                'label' => 'Номер урока',
                'value' => 'lesson_number',
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Schedule $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
