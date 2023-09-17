<?php

use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\UserSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Список всех пользователей';

?>

<div class="admin-user-index">
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

        <div class="user-index">

            <h1><?= Html::encode($this->title) ?></h1>

            <p>
                <?= Html::a('Добавить нового пользователя', ['create'], ['class' => 'btn btn-primary']) ?>
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

                    // 'id',
                    // 'gender_id',
                    [
                        'label' => 'ФИО пользователя',
                        'value' => function ($model) {
                            return $model->name . ' ' . $model->patronymic . ' ' . $model->surname;
                        }
                    ],
                    [
                        'attribute' => 'role',
                        'value' => function($model){
                            $id = $model->id;
                            return Yii::$app->user->identity->getRoles($id);
                        }
                    ],
                    [
                        'label' => 'Логин',
                        'value' => function ($model) {
                            return $model->login;
                        }
                    ],
                    [
                        'label' => 'Контактные данные',
                        'value' => function ($model) {
                            return 'email: ' . $model->email . ', телефон: ' . $model->phone;
                        }
                    ],
                    [
                        'label' => 'Действия',
                        'format' => 'raw',
                        'value' => function ($model) {
                                $btn_view = Html::a('<i class="fa fa-eye"></i>', ['view', 'id' => $model->id]);
                                $btn_edit = Html::a('<i class="fas fa-pencil-alt"></i>', ['update', 'id' => $model->id]);
                                $btn_delete = Html::a('<i class="far fa-trash-alt"></i>', ['delete', 'id' => $model->id], ['class' => 'delete-row',
                                        'data' => [
                                            'confirm' => 'Вы уверены, что хотите удалить пользователя?',
                                            'method' => 'post',
                                        ]]);
                                return '<div class="actions">' . $btn_view . ' ' . $btn_edit . ' ' . $btn_delete . '</div>';
                            }
                    ],
                ],
            ]); ?>

            <?php Pjax::end(); ?>

        </div>
    </section>
</div>
