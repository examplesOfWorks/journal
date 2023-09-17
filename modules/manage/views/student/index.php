<?php

use app\models\Student;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\NewStudentSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Список студентов по группам';

?>
<div class="student-index">
    <div class="section_title text-center">
        <div class="d-flex justify-content-center">
            <h3><?= Html::encode($this->title) ?></h3>
        </div>
    </div>

    <div class="popular_program_area program__page">
        <div class="container">

            <h1><?= Html::encode($this->title) ?></h1>

            <p>
                <?= Html::a('Добавить студента в группу', ['create'], ['class' => 'btn btn-primary']) ?>
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
                        'attribute' => 'user_id',
                        'label' => 'ФИО студента',
                        'value' => function($model) {
                            return $model->user->name . ' ' . $model->user->patronymic . ' ' . $model->user->surname;
                        }
                    ],
                    [
                        'attribute' => 'group_id',
                        'label' => 'Группа',
                        'value' => function($model) {
                            return $model->group->title;
                        }
                    ],
                    [
                        'label' => 'Действия',
                        'format' => 'raw',
                        'value' => function ($model) {
                            $btn_edit = Html::a('<i class="fa fa-pencil"></i>', ['update', 'id' => $model->id]);
                            $btn_delete = Html::a('<i class="fa fa-trash"></i>', ['delete', 'id' => $model->id], ['class' => 'delete-row',
                                'data' => [
                                    'confirm' => 'Вы уверены, что хотите эту запись?',
                                    'method' => 'post',
                                ]]);
                            return '<div class="actions">' . ' ' . $btn_edit . ' ' . $btn_delete . '</div>';
                        }
                    ],
                ],
            ]); ?>

            <?php Pjax::end(); ?>
        </div>
    </div>
</div>
