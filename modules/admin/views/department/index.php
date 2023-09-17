<?php

use app\models\Department;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\DepartmentSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Управление отделениями';

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

        <div class="department-index">

            <h1><?= Html::encode($this->title) ?></h1>

            <p>
                <?= Html::a('Добавить отделение', ['create'], ['class' => 'btn btn-primary']) ?>
            </p>

            <?php Pjax::begin(); ?>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                // 'filterModel' => $searchModel,
                'tableOptions' => [
                    'class' => 'table table-responsive-md table-hover mb-0'
                ],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'label' => 'ФИО заведующего отделением',
                        'value' => function ($model) {
                            return $model->user->name . ' ' . $model->user->patronymic . ' ' . $model->user->surname;
                        }
                    ],
                    [
                        'label' => 'Название отделения',
                        'value' => function ($model) {
                            return $model->title;
                        }
                    ],
                    [
                        'label' => 'Действия',
                        'format' => 'raw',
                        'value' => function ($model) {
                                $btn_edit = Html::a('<i class="fas fa-pencil-alt"></i>', ['update', 'id' => $model->id]);
                                $btn_delete = Html::a('<i class="far fa-trash-alt"></i>', ['delete', 'id' => $model->id], ['class' => 'delete-row',
                                        'data' => [
                                            'confirm' => 'Вы уверены, что хотите удалить запись об этом отделении?',
                                            'method' => 'post',
                                        ]]);
                                return '<div class="actions">' . $btn_edit . ' ' . $btn_delete . '</div>';
                            }
                    ],
                ],
            ]); ?>

            <?php Pjax::end(); ?>

        </div>
    </section>
</div>