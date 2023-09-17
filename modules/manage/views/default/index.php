<?php

use yii\bootstrap5\Html;
use yii\helpers\VarDumper;

/** @var yii\web\View $this */
/** @var app\models\SubjectUser $model */

$this->title = 'Управление учебным процессом';

\yii\web\YiiAsset::register($this);
?>

<div class="manage-default-index">

    <div class="section_title text-center">
        <div class="d-flex justify-content-center">
            <h3><?= Html::encode($this->title) ?></h3>
        </div>
    </div>
    
    <div class="popular_program_area program__page">
        <div class="container">
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="single__program">
                                <div class="program_thumb">
                                </div>
                                <div class="program__content">
                                    <span>Группы</span>
                                    <h4>Управление группами</h4>
                                    <?= (Yii::$app->user->identity->getRoles(Yii::$app->user->identity->id) ==  'Заведующий отделением') ?
                                        '<p style="height: 6.5rem;">Доступно: группы отделения "' .  $myDepartment . '"</p>' : 
                                        '<p style="height: 6.5rem;"></p>'?>
                                    <?= Html::a('Перейти...', ['/manage/group'], ['class' => 'boxed-btn5']) ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="single__program">
                                <div class="program_thumb">
                                    <!-- <i class="fas fa-user"></i> -->
                                </div>
                                <div class="program__content">
                                    <span>Организация учебного процесса</span>
                                    <h4>Назначение преподавателей</h4>
                                    <p style="height: 5rem;"></p>
                                    <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut</p> -->
                                    <?= Html::a('Перейти...', ['/manage/subject-user'], ['class' => 'boxed-btn5']) ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="single__program">
                                <div class="program_thumb">
                                    <!-- <i class="fas fa-user"></i> -->
                                </div>
                                <div class="program__content">
                                    <span>Управление группами</span>
                                    <h4>Добавление студентов в группы</h4>
                                    <p style="height: 5rem;"></p>
                                    <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut</p> -->
                                    <?= Html::a('Перейти...', ['/manage/student'], ['class' => 'boxed-btn5']) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    
</div>



    


</div>




    