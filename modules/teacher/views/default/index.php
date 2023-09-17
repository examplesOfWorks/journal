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

$this->title = 'Мои предметы';

?>
<div class="schedule-index">

<?= Html::a('<i class="fa fa-arrow-left" aria-hidden="true"></i>', ['/site/about'], ['class' => 'btn btn-primary ml-4 mt-2']) ?>

    <div class="popular_program_area program__page">
        <div class="container">
            <div class="single__program">
                <div class="program__content">
        
                    <div class="section_title text-center">
                        <div class="d-flex justify-content-center mb-4">
                            <h3><?= Html::encode($this->title) ?></h3>
                        </div>
                    </div>

                    <div class="popular_program_area program__page">

                        <div class="container">
                            <div class="subject-user-index">

                                <?php Pjax::begin(); ?>
                                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                                <?= GridView::widget([
                                    'dataProvider' => $dataProvider,
                                    'summary' => false,
                                    'tableOptions' => [
                                        'class' => 'table table-responsive-xxl table-hover mb-0'
                                    ],
                                    'columns' => [
                                        ['class' => 'yii\grid\SerialColumn'],
                                        [
                                            'attribute' => 'subject_name_id',
                                            'label' => 'Название предмета',
                                            'value' => function ($model) {
                                                return $model['title'];
                                            }

                                        ],
                                        [
                                            'format' => 'raw',
                                            'value' => function ($model) {
                                                return Html::a('<i class="ti-eye"></i>', ['/teacher/group/index', 'subject_name_id' => $model['id']]);
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
</div>