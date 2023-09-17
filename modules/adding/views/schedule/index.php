<?php

use app\models\Schedule;
use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\NewScheduleSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Управление расписанием';

?>
<div class="schedule-index">

    <div class="section_title text-center">
        <div class="d-flex justify-content-center">
            <h3><?= Html::encode($this->title) ?></h3>
        </div>
    </div>

    <div class="popular_program_area program__page">
        <div class="container">

            <p>
                <?= Html::a('Внести новую запись', ['create'], ['class' => 'btn btn-primary']) ?>
            </p>

            <?php Pjax::begin(); ?>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                // 'filterModel' => $searchModel,
                'tableOptions' => [
                    'class' => 'table table-responsive-md table-hover mb-0'
                ],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'subject_user_id',
                        'label' => 'Назначенный преподаватель (группа, предмет)',
                        'value' => function ($model) {
                            return $model->subjectUser->user->name . ' ' . $model->subjectUser->user->patronymic . ' ' . $model->subjectUser->user->surname 
                                    . ' (' . $model->subjectUser->group->title . ') '. $model->subjectUser->subjectName->title;
                        }
                    ],
                    [
                        'attribute' => 'date',
                        'label' => 'Дата',
                        'value' => function ($model) {
                            return $model->date;
                        }
                    ],
                    [
                        'attribute' => 'lesson_number',
                        'label' => 'Номер урока',
                        'value' => function ($model) {
                            return $model->lesson_number;
                        }
                    ],
                    [
                        'label' => 'Действия',
                        'format' => 'raw',
                        'value' => function ($model) {
                            $btn_edit = Html::a('<i class="fa fa-pencil"></i>', ['update', 'id' => $model->id]);
                            $btn_delete = Html::a('<i class="fa fa-trash"></i>', ['delete', 'id' => $model->id], ['class' => 'delete-row',
                                'data' => [
                                    'confirm' => 'Вы уверены, что хотите удалить предмет?',
                                    'method' => 'post',
                                ]]);
                            return '<div class="actions">' . $btn_edit . ' ' . $btn_delete . '</div>';
                        }
                    ],
                ],
            ]); ?>

            <?php Pjax::end(); ?>
        </div>
    </div>

</div>
