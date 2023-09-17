<?php 

use yii\helpers\VarDumper;
use app\models\Group;
use app\models\SubjectUser;
use yii\widgets\ListView;
use yii\bootstrap5\Html;
?>

<div class="viewing-default-index">
    <?= Html::a('<i class="fa fa-arrow-left" aria-hidden="true"></i>', ['/site/about'], ['class' => 'btn btn-primary ml-4 mt-2'])?>
    <div class="section_title text-center">
        <div class="d-flex justify-content-center">
            <h3>Мои предметы</h3>
        </div>
        <p>Студент группы <?= $myGroup ?></p>
    </div>

    <div class="popular_program_area program__page">
        <div class="container">
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <?= ListView::widget([
                    'dataProvider' => $dataProviderLessons,
                    'itemOptions' => ['class' => 'item'],
                    'layout' => '<div class="mt-3">{pager}</div><div class="d-flex flex-wrap justify-content-between">{items}</div>{pager}',
                    'itemView' => function ($model, $key, $index, $widget) {
                        return '<div class="single__program">'
                                .'<div class="program_thumb">
                                    <!-- <i class="fas fa-user"></i> -->
                                </div>'
                                .'<div class="program__content">'
                                    .'<h4>'. $model['title'] .'</h4>'
                                    . '<p style="height: 5rem;">Преподаватель: '. $model['name'] .' '.
                                        $model['patronymic'] .' '. $model['surname'] .'</p>'
                                    . Html::a('Выбрать предмет...', ['/viewing/view-marks', 'subject_name_id' => $model['id'], 'year' => date('Y'), 'page' => 1], ['class' => 'boxed-btn5'])
                                .'</div>'
                            .'</div>';
                    },
                ]) ?>
                </div>
            </div>
        </div>
    </div>

    

</div>