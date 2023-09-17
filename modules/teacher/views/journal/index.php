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
$thisMonth = $dataProviderMonth->getModels();

?>

<?php 

foreach ($dateList as $dateItem) {
    foreach ($markList as $markItem) {
        $mark = ($dateItem['id'] == $markItem['lesson_id']) ? $markItem['mark'] : '';   
    }

    $lessons[] = $dateItem['lesson'];
    $dates[] = $dateItem;
    
}

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
                
        <div class="single-element-widget mt-30">
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
                        <?= Html::a('<i class="fa fa-check-circle-o" aria-hidden="true"></i>', ['/teacher/journal/index', 
                        'subject_name_id' => $subject_name_id, 'group_id' => $group_id, 'year' => (isset($y)) ? $y : $valueYear, 'page' => 1], 
                        ['class' => 'btn btn-primary ms-2', 'data-method' => 'post']) ?>
                    </div>
                    
                </div>
            </div>    
        </div>

            <?php Pjax::begin(['enablePushState' => false, 'enableReplaceState' => false]); ?>
        <div class="journal">
            <?= ListView::widget([
                    'dataProvider' => $dataProviderMonth,
                    'summary' => false,
                    'itemOptions' => ['class' => 'item'],
                    'layout'=>"{summary}\n{items}",
                    'pager' => ['class' => \yii\bootstrap5\LinkPager::class],
                    'itemView' => function ($model, $key, $index, $widget) use ($studentsFromGroup, $dates, $modelMark, 
                        $subjectName, $datesNumber, $subject_name_id, $dataProviderMonth, $monthsTranslation, $valueYear, $years ) {
                        $valueMonth = $model;
        
                        $monthsRus = $monthsTranslation[strtok($model, " ")];
                        $screenCount = $dataProviderMonth->allModels;

                        isset(Yii::$app->request->get()['page']) ? $page = Yii::$app->request->get()['page'] : $page = null;
                        isset(Yii::$app->request->get()['per-page']) ? $page = Yii::$app->request->get()['per-page'] : $per_page = null;

                        $leftMonth = Html::a('<i class="fa fa-chevron-circle-left" aria-hidden="true"></i>',
                            ['/teacher/journal/index', 'subject_name_id' => $subject_name_id, 'group_id' => Yii::$app->request->get()['group_id'], 'year' => Yii::$app->request->get()['year'],
                            'page'=> ($page > 1 ? $page-1 : $page)], ['class' => 'btn btn-primary me-2', 'data-method' => 'post']);
                        $rightMonth = Html::a('<i class="fa fa-chevron-circle-right" aria-hidden="true"></i>',
                             ['/teacher/journal/index', 'subject_name_id' => $subject_name_id, 'group_id' => Yii::$app->request->get()['group_id'], 'year' => Yii::$app->request->get()['year'],
                            'page'=> ($page < count($screenCount) ? $page+1 : $page)], ['class' => 'btn btn-primary ms-2', 'data-method' => 'post']);
                            
                            echo ' <div class="row">
                            
                                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6	col-xxl-6">
                                        <span>Выбранный месяц:</span>
                                            <div class="d-flex justify-content-start">' . $leftMonth
                                                . '<div class="row">
                                                
                                                    <div class="col-lg-12">
                                                    
                                                        <input class="form-control " type="text" value=" ' . $monthsRus . '" 
                                                            aria-label="readonly input example" readonly>
                                                    </div>
                                                </div>'
                                                . ' ' . $rightMonth 
                                            . '</div>
                                        </div>
                                        
                                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6	col-xxl-6">
                                            <div class="mt-2 d-flex justify-content-end">
                                                <span>Сегодня: '.  date('d.m.Y') . '</span>
                                            </div>
                                        </div>
                                    </div>';
                            

                        $teacher_id = Yii::$app->user->id;
                        $subject_name_id = Yii::$app->request->get()['subject_name_id'];
                        $group_id = Yii::$app->request->get()['group_id'];
                        $lessonCountPerMonth = Schedule::getDatesNumber($teacher_id, $subject_name_id, $group_id, $valueMonth);
                        

                        foreach ($lessonCountPerMonth as $val) {
                            if (date('Y-m-d') > $val) {
                                $datesArr[] = $val;
                                
                            }
                        }
                    
                        echo '<div class="my-3"><span>'
                                . (isset($datesArr) ? ' Прошло за этот месяц '
                                . (isset($datesArr) ? count($datesArr): '') . ' уроков ' . ' из ' . count($lessonCountPerMonth) :
                                ' Прошло за этот месяц ' . 0 . ' уроков  из ' . count($lessonCountPerMonth)) .
                            '</span></div>';

                        foreach ($dates as $date) {
                            
                            $screenMonth = \Yii::$app->formatter->asDate($date['date'], 'php:F');

                            if ($screenMonth == strtok($valueMonth, " ")) {

                                $screenDateList[] = $date;

                            }

                        }
                        $columns = [
                            ['class' => 'yii\grid\SerialColumn'],
                            
                            [
                                'headerOptions' => ['style' => 'background-color:#007bff54;'],
                                'contentOptions' => ['style' => 'background-color:#007bff31;'],
                                'attribute' => 'student_id',
                                'label' => 'ФИО студента',
                                'format' => 'raw',
                                'value' => function ($model) {
                                    return $model['surname'] . ' ' . $model['name'] . ' ' . $model['patronymic'];
                                }
                            ]];

                        $mas_mark = array_map(fn($el) => [
                            'label' => $el['lesson'],
                            'format' => 'raw',
                            'value' => function ($model) use ($el, $screenMonth, $valueMonth, $modelMark, $datesNumber, $lessonCountPerMonth) {
                                $student = $model['id'];
                                $mark = Mark::getMark($student, $el['date'], $el['id']);

                                if (!empty($mark)) {
                                    $subject_name_id = Yii::$app->request->get()['subject_name_id'];
                                    $group_id = Yii::$app->request->get()['group_id'];
                                    $year = Yii::$app->request->get()['year'];
                                    $page = Yii::$app->request->get()['page'];

                                    $btn_edit = Html::a('<i class="fa fa-eraser" aria-hidden="true"></i>', 
                                    ['delete', 'id' => $mark[0]['id'], 'subject_name_id' => $subject_name_id, 'group_id' => $group_id, 
                                    'year' => $year, 'page' => $page], ['class' => 'btn btn-light', 
                                    'data' => [
                                        'confirm' => 'Вы уверены, что хотите стереть отметку?',
                                        'method' => 'post',
                                    ],
                                ]);
                                    return '<div class="row"><div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12
                                            d-flex justify-content-center mt-2"><div class="with-mark">' . $mark[0]['mark'] . '</div></div>' . 
                                            '<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 
                                            d-flex justify-content-end mt-4">' . $btn_edit . 
                                            '</div></div>';

                                } else {

                                    if ($el['date'] <= date('Y-m-d')) {
                                        $student_id = Student::getStudentByUserId($model['id']);
                                        $lesson_id = $el['id'];
                                        return $this->render('_formMark', compact('model', 'modelMark', 'student_id', 'lesson_id'));
                                    } else {
                                        return '';
                                    }

                                }

                            }
                        ], $screenDateList);

                        $average_mark = [
                        [   
                            'format' => 'raw',
                            'headerOptions' => ['style' => 'background-color:#2326379f;'],
                            'contentOptions' => ['style' => 'background-color:#23263757;'],
                            'label' => 'ср. оц. за месяц',
                            'value' => function ($model) use ($valueMonth, $subjectName, $dates) {
                                $student_id = Student::getStudentByUserId($model['id']);
                                $averageMark = Mark::getAverageMark($student_id, $valueMonth, $subjectName);
                                return count($averageMark)!= 0 ? '<div class="text-center">' .
                                        round(array_sum($averageMark)/count($averageMark), 1) . '</div>' : '';
                            }
                        ]];

                        $average_attendance = [
                        [
                            'format' => 'raw',
                            'headerOptions' => ['style' => 'background-color:#383d589f;'],
                            'contentOptions' => ['style' => 'background-color:#525d994d;'],
                            'label' => 'пропущено за месяц',
                            'value' => function ($model) use ($valueMonth, $subjectName, $datesNumber, $lessonCountPerMonth) {
                                $student_id = Student::getStudentByUserId($model['id']);
                                $value = Mark::getAverageAttendance($student_id, $valueMonth, $subjectName);
                                return '<div class="text-center">' . 
                                        count($value) . ' из ' .  count($lessonCountPerMonth) . ' уроков' . '</div>';
                            }
                        ]];

                        $columns = array_merge($columns, $mas_mark, $average_mark, $average_attendance);

                        return GridView::widget([
                            'dataProvider' => new ArrayDataProvider(['allModels' => $studentsFromGroup]),
                            'tableOptions' => [
                                'class' => 'table table-light table-hover table-bordered w-100'
                            ],
                            'options' => [
                                'class' => 'table-responsive',
                            ],
                            'summary' => false,
                            'columns' => $columns,
                        ]);

                    }
                ])?>

            </div>
                
                <?php Pjax::end(); ?>
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