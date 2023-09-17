<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\User $model */

$this->title = 'Редактирование данных о пользователе: ' . $model->name;
?>

<div class="admin-user-update">
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
        <div class="user-update">

            <h1><?= Html::encode($this->title) ?></h1>

            <?= $this->render('_formUpdate', [
                'model' => $model,
                'roleName' => $roleName,
                'genders' => $genders,
            ]) ?>

        </div>
    </section>
</div>