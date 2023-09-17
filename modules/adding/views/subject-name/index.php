<?php

use app\models\SubjectName;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\SubjectNameSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Названия предметов';

?>
<div class="subject-name-index">

    <div class="section_title text-center">
        <div class="d-flex justify-content-center">
            <h3><?= Html::encode($this->title) ?></h3>
        </div>
    </div>

    <div class="popular_program_area program__page">
        <div class="container">

            <p>
                <?= Html::a('Добавить новый предмет', ['create'], ['class' => 'btn btn-primary']) ?>
            </p>

            <?php Pjax::begin(); ?>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                // 'filterModel' => $searchModel,
                'tableOptions' => [
                    'class' => 'table table-responsive-xxl table-hover mb-0'
                ],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'title',
                    // [
                    //     'class' => ActionColumn::className(),
                    //     'urlCreator' => function ($action, SubjectName $model, $key, $index, $column) {
                    //         return Url::toRoute([$action, 'id' => $model->id]);
                    //     }
                    // ],
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
