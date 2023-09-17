<?php

use yii\bootstrap5\Html;

/** @var yii\web\View $this */
/** @var app\models\SubjectUser $model */

$this->title = 'Добавление новых данных';

\yii\web\YiiAsset::register($this);
?>

    
<div class="adding-default-index">
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
                                    <span>Пользователи</span>
                                    <h4>Управление пользователями</h4>
                                    <p style="height: 5rem;">Доступные категории пользователей: преподаватели, студенты, родители</p>
                                    <?= Html::a('Перейти...', ['/adding/user'], ['class' => 'boxed-btn5']) ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="single__program">
                                <div class="program_thumb">
                                </div>
                                <div class="program__content">
                                    <span>Добавление новых данных</span>
                                    <h4>Управление названиями предметов</h4>
                                    <p style="height: 3.2rem;"></p>
                                    <?= Html::a('Перейти...', ['/adding/subject-name'], ['class' => 'boxed-btn5']) ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="single__program">
                                <div class="program_thumb">
                                </div>
                                <div class="program__content">
                                    <span>Организация учебного процесса</span>
                                    <h4>Управление расписанием</h4>
                                    <p style="height: 5rem;"></p>
                                    <?= Html::a('Перейти...', ['/adding/schedule'], ['class' => 'boxed-btn5']) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    
</div>
