<?php

use yii\helpers\VarDumper;
use yii\widgets\ListView;
use yii\bootstrap5\Html;

// VarDumper::dump($myChildren, 10, true);
?>

<div class="viewing-default-index">
    <div class="section_title text-center">
        <div class="d-flex justify-content-center">
            <h3>Дети</h3>
        </div>
    </div>

    <div class="popular_program_area program__page">
        <div class="container">
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <?= ListView::widget([
                    'dataProvider' => $dataProviderChildren,
                    'itemOptions' => ['class' => 'item'],
                    'layout' => '<div class="mt-3">{pager}</div><div class="d-flex flex-wrap justify-content-between">{items}</div>{pager}',
                    'itemView' => function ($model, $key, $index, $widget) {
                        return '<div class="single__program">'
                                .'<div class="program_thumb">
                                    <!-- <i class="fas fa-user"></i> -->
                                </div>'
                                .'<div class="program__content">'
                                    . '<p style="height: 5rem;">Ребёнок: '. $model['name'] .' '.
                                        $model['patronymic'] .' '. $model['surname'] .'</p>'
                                    . Html::a('Посмотреть успеваемость...', ['/viewing/default/subject', 'student_id' => $model['child_id']], ['class' => 'boxed-btn5'])
                                .'</div>'
                            .'</div>';
                    },
                ]) ?>
                </div>
            </div>
        </div>
    </div>


</div>