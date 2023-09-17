<?php

/** @var yii\web\View $this */

$this->title = 'Электронный журнал преподавателя';
?>
<div class="event_details_area section__padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="single_event d-flex align-items-center">
                        <div class="event_details_info">
                            <div class="event_info">
                                <a href="#">
                                    <h4>Добро пожаловать, <?= Yii::$app->user->identity->name ?>!</h4>
                                    <p>Ваша роль: <?= Yii::$app->user->identity->getRoles(Yii::$app->user->identity->id) ?></p>
                                 </a>
                            </div>
                            <p class="event_info_text"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>