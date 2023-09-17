<?php

/** @var yii\web\View $this */

use yii\bootstrap5\Html;

?>
    <div class="latest_coures_area h-100">
        <div class="latest_coures_inner">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="coures_info">
                            <div class="section_title white_text">
                                <h3>О системе</h3>
                                <p> АИС Электронный журнал преподавателя <br> - это система для преподавателей, учащихся и их родителей,<br> 
                                а также административной части учебного заведения, созданная <br>
                                для учета успеваемости и посещаемости.</p>
                            </div>
                            <?= Yii::$app->user->isGuest ?
                                '<div class="coures_wrap d-flex">
                                    <div class="single_wrap">
                                        <!-- <div class="icon">
                                            <i class="flaticon-lab"></i>
                                        </div> -->
                                        <h4>Чтобы воспользоваться функциями журнала,<br>
                                            пожалуйста, войдите в систему</h4>
                                            <a href="/site/login" class="boxed-btn5">Войти</a>
                                    </div>
                                </div>': '' 
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>