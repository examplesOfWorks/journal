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


foreach ($dateList as $dateItem) {

    $lessons[] = $dateItem['lesson'];
    $dates[] = $dateItem;
    
}

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

            <div class="row">
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6	col-xxl-6">
                    <span>Выбранный год</span>
                    <div class="default-select" id="default-select">
                        <select>
                            <option> <?= $valueYear ?> </option> 
                                <?php foreach ($years as $year) { 
                                    if ($year != $valueYear) { 
                                    echo '<option>'. $year . '</option>';
                                    $y = $year;
                                }
                            }?>
                        </select> 
                        <?= Html::a('<i class="fa fa-check-circle-o" aria-hidden="true"></i>', ['/viewing/view-marks', 
                            'subject_name_id' => $subject_name_id, 'student_id' => Yii::$app->request->get('student_id'), 
                            'year' => (isset($y)) ? $y : $valueYear, 'page' => 1], 
                            ['class' => 'btn btn-primary ms-2', 'data-method' => 'post']) ?>
                    </div>
                    
                </div>
            </div>
        

                <?php Pjax::begin(); ?>

                <?= ListView::widget([
                    'dataProvider' => $dataProviderMonth,
                    'summary' => false,
                    'layout'=>"{summary}\n{items}",
                    'itemOptions' => ['class' => 'item'],
                    'pager' => ['class' => \yii\bootstrap5\LinkPager::class],
                    'itemView' => function ($model, $key, $index, $widget) use ($dates, $dataProviderStudent, $monthsTranslation, 
                    $dataProviderMonth,  $subject_name_id, $thisRole, $subjectName) {
                        
                        $valueMonth = $model;

                        $monthsRus = $monthsTranslation[strtok($model, " ")];  
                        $screenCount = $dataProviderMonth->allModels;

                        isset(Yii::$app->request->get()['page']) ? $page = Yii::$app->request->get()['page'] : $page = null;
                        isset(Yii::$app->request->get()['per-page']) ? $page = Yii::$app->request->get()['per-page'] : $per_page = null;

                        if ($thisRole == 'Родитель') {
                            $leftMonth = Html::a('<i class="fa fa-chevron-circle-left" aria-hidden="true"></i>',
                            ['/viewing/view-marks', 'subject_name_id' => $subject_name_id, 'student_id' => Yii::$app->request->get()['student_id'],
                             'year' => Yii::$app->request->get()['year'],
                            'page'=> ($page > 1 ? $page-1 : $page)], ['class' => 'btn btn-primary me-2', 'data-method' => 'post']);
                            $rightMonth = Html::a('<i class="fa fa-chevron-circle-right" aria-hidden="true"></i>',
                             ['/viewing/view-marks', 'subject_name_id' => $subject_name_id, 'student_id' => Yii::$app->request->get()['student_id'], 
                             'year' => Yii::$app->request->get()['year'],
                            'page'=> ($page < count($screenCount) ? $page+1 : $page)], ['class' => 'btn btn-primary ms-2', 'data-method' => 'post']);
                        } else {
                            $leftMonth = Html::a('<i class="fa fa-chevron-circle-left" aria-hidden="true"></i>',
                            ['/viewing/view-marks', 'subject_name_id' => $subject_name_id,
                             'year' => Yii::$app->request->get()['year'],
                            'page'=> ($page > 1 ? $page-1 : $page)], ['class' => 'btn btn-primary me-2', 'data-method' => 'post']);
                            $rightMonth = Html::a('<i class="fa fa-chevron-circle-right" aria-hidden="true"></i>',
                             ['/viewing/view-marks', 'subject_name_id' => $subject_name_id, 
                             'year' => Yii::$app->request->get()['year'],
                            'page'=> ($page < count($screenCount) ? $page+1 : $page)], ['class' => 'btn btn-primary ms-2', 'data-method' => 'post']);
                        }

                        
                        
                            echo '<div class="row mb-3">
                            
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6	col-xxl-6">
                                <span>Выбранный месяц:</span>
                                <div class="d-flex justify-content-start">' . $leftMonth
                                    . '<div class="row">
                                    
                                        <div class="col-lg-12">
                                        
                                            <input class="form-control" type="text" value=" ' . $monthsRus . '" 
                                                aria-label="readonly input example" readonly>
                                        </div>
                                    </div>'
                                    . ' ' . $rightMonth 
                                . '</div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6	col-xxl-6">
                                <div class="mt-2 d-flex justify-content-end">
                                    <p>Сегодня: '.  date('d.m.Y') . '</p>
                                </div>
                            </div>
                        </div>';
                        
                        foreach ($dates as $date) {

                            $screenDate = \Yii::$app->formatter->asDate($date['date'], 'php:j');
                            $screenMonth = \Yii::$app->formatter->asDate($date['date'], 'php:F');
                            if ($screenMonth == strtok($valueMonth, " ")) {

                                $screenDateList[] = $date;

                            }

                        }

                        $columns = [
                            ['class' => 'yii\grid\SerialColumn'],
                        [
                            'attribute' => 'student_id',
                            'label' => 'ФИО студента',
                            'value' => function ($model) {
                                return $model['name'] . ' ' . $model['patronymic'] . ' ' . $model['surname'];
                            }
                        ]];

                        $mas_mark = array_map(fn($el) => [
                            'label' => $el['lesson'],
                            'format' => 'raw',
                            'value' => function ($model) use ($el) {
                                    $student = $model['user_id'];
                                    $mark = Mark::getMark($student, $el['date'], $el['id']);
                                    return  !empty($mark[0]['mark']) ? $mark[0]['mark'] : '';

                            }
                        ], $screenDateList);

                        $columns = array_merge($columns, $mas_mark);

                        return GridView::widget([
                            'tableOptions' => [
                                'class' => 'table table-light table-hover table-bordered w-100',
                            ],
                            'options' => [
                                'class' => 'table-responsive',
                            ],
                            'dataProvider' => $dataProviderStudent,
                            'summary' => false,
                            'columns' => $columns,
                        ]);
                    }])?>
                <?php Pjax::end(); ?>
            </div>
            </div>
        </div>
    </div>
</div>
                  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script>
var scrl, storage;
storage = sessionStorage.getItem('value');
console.log('Session storage: ' + storage);

$(document).ready(function() {
  window.scrollTo(0, storage);
});

$(window).on("scroll", function() {
  scrl = $(window).scrollTop();
  console.log('Scroll position: ' + $(window).scrollTop());
  sessionStorage.setItem('value', scrl);
});
</script>