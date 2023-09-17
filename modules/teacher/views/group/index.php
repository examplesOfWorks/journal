<?php

use app\models\SubjectUser;
use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\helpers\VarDumper;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\SubjectUserSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Группы';

?>
<div class="subject-user-index">

<?= Html::a('<i class="fa fa-arrow-left" aria-hidden="true"></i>', ['/teacher/default/index', 'subject_name_id' => $subject_name_id], 
['class' => 'btn btn-primary ml-4 mt-2']) ?>
    
    <div class="popular_program_area program__page">
        <div class="container">
            <div class="single__program">
                <div class="program__content">
                   
                    <div class="section_title text-center">

                        <p>Выбранный предмет: <?= $subjectName ?></p>
                        <div class="d-flex justify-content-center mb-4">
                            <h3><?= Html::encode($this->title) ?></h3>
                        </div>
                    </div>

                    <div class="popular_program_area program__page">
                        <div class="container">

                            <?php Pjax::begin(); ?>
                            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                            <?= GridView::widget([
                                'dataProvider' => $dataProvider,
                                'summary' => false,
                                // 'filterModel' => $searchModel,
                                'tableOptions' => [
                                    'class' => 'table table-responsive-xxl table-hover mb-0'
                                ],
                                'columns' => [
                                    ['class' => 'yii\grid\SerialColumn'],
                                    [
                                        'attribute' => 'group_id',
                                        'label' => 'Название группы',
                                        'value' => function ($model) {
                                            return $model->group->title;
                                        }
                                    ],
                                    [
                                        'format' => 'raw',
                                        'value' => function ($model) use ($subject_name_id) {
                                            $btn_teaching = '<div>' . Html::a('<i class="ti-book"></i>', ['/teacher/journal/index', 
                                                'subject_name_id' => $subject_name_id, 'group_id' => $model->group_id, 'year' => date('Y'), 'page' => 1]) . '</div>';
                                            return $btn_teaching;
                                        }
                                    ],
                                ],
                            ]); ?>

                            <?php Pjax::end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
