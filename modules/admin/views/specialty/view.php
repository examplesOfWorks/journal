<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Specialty $model */

$this->title = $model->title;
\yii\web\YiiAsset::register($this);
?>

<div class="admin-specialty-view">
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

        <div class="specialty-view">

            <h1><?= Html::encode($this->title) ?></h1>

            <p>
                <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Вы уверены, что хотите удалить данные об этой специальности?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                        'label' => 'Название отделения',
                        'value' => function ($model) {
                            return $model->department->title;
                        }
                    ],
                    [
                        'label' => 'Название специальности',
                        'value' => function ($model) {
                            return $model->title;
                        }
                    ],
                ],
            ]) ?>

        </div>
    </section>
</div>