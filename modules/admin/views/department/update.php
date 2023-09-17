<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Department $model */

$this->title = 'Редактировать данные об отделении: ' . $model->title;

?>
<div class="admin-default-index">
    <section role="main" class="content-body">
        <header class="page-header">
            <h2><?= $this->title ?></h2> 
			<div class="right-wrapper text-end">
                    <ol class="breadcrumbs">
                        <li>
                            <a href="/admin/default/index">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>

                        <li><span><?=$this->title?></span></li>

                    </ol>

                    <?= Html::a('<i class="fas fa-chevron-left"></i>', ['/admin/default/index'], ['class' => 'sidebar-right-toggle', 'data-open' => 'sidebar-right']) ?>
                </div>      
        </header>
        <div class="department-update">

            <h1><?= Html::encode($this->title) ?></h1>

            <?= $this->render('_form', [
                'model' => $model,
                'head_of_departmentList' => $head_of_departmentList,
            ]) ?>

        </div>
    </section>
</div>