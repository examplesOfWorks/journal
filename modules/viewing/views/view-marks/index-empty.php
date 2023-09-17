<?php

use app\models\Mark;
use app\models\Group;
use app\models\Student;
use yii\helpers\Html;
use yii\helpers\VarDumper;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ListView;
use yii\data\ArrayDataProvider;
/** @var yii\web\View $this */
/** @var app\models\MarkViewSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$thisRole = Yii::$app->user->identity->getRoles(Yii::$app->user->id);

$thisRole == 'Студент' ? $this->title = 'Моя успеваемость' : $this->title = 'Успеваемость моего ребёнка';


?>

<div class="mark-index">

    <div class="popular_program_area program__page">
        <div class="single__program">
            <div class="program__content">
                <?= $thisRole == 'Студент'
                    ? Html::a('<i class="fa fa-arrow-left" aria-hidden="true"></i>', ['/viewing/default'], ['class' => 'btn btn-primary']) :
                    Html::a('<i class="fa fa-arrow-left" aria-hidden="true"></i>', ['/viewing/default/subject', 'student_id' => Yii::$app->request->get()['student_id']], ['class' => 'btn btn-primary']) ?>
                <h4><?= Html::encode($this->title) ?></h4>
                <p>Выбранный предмет: <?= $subjectName ?><p>
                <div>

                    <span>Для этой группы журнал пока не создан.</span>
                    
                </div>
            </div>
        </div>
    </div>
</div>


