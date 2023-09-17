<?php

use app\models\Mark;
use app\models\Student;
use app\models\Schedule;
use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\helpers\VarDumper;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ListView;
use yii\widgets\LinkPager;
use yii\data\ArrayDataProvider;
use yii\data\Pagination;
/** @var yii\web\View $this */
/** @var app\models\MarkSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Журнал оценок и посещаемости студентов';

?>

<div class="mark-index">
    
    <div class="popular_program_area program__page">
        <div class="single__program">
            <div class="program__content">
                <?= Html::a('<i class="fa fa-arrow-left" aria-hidden="true"></i>', ['/teacher/group/index', 'subject_name_id' => $subject_name_id], 
                ['class' => 'btn btn-primary']) ?>
                <h4>
                    Выбранная группа: <?= $group_name ?> | Выбранный предмет: <?= $subjectName ?>
                </h4>

                <div class="my-4">
                    <h4><?= Html::encode($this->title) ?></h4>
                </div>

                <div>
                    <span>Для этой группы журнал пока не создан.</span>
                </div>

            </div>
        </div>
    </div>
</div>







    

    