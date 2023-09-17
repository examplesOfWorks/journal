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
<div class="user-index">

        <div class="section_title text-center">
            <div class="d-flex justify-content-center">
                <h3><?= Html::encode($this->title) ?></h3>
            </div>
            <p>Доступные роли: преподаватели, студенты, родители</p>
        </div>

        <div class="popular_program_area program__page">
            <div class="container">

                <p>
                    <?= Html::a('Добавить нового пользователя', ['create'], ['class' => 'btn btn-primary']) ?>
                </p>

                <?php Pjax::begin(); ?>
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    // 'filterModel' => $searchModel,
                    'tableOptions' => [
                        'class' => 'table table-responsive-xxl table-hover mb-0'
                    ],
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
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
                                    $btn_edit = Html::a('<i class="fa fa-pencil"></i>', ['update', 'id' => $model->id]);
                                    $btn_delete = Html::a('<i class="fa fa-trash"></i>', ['delete', 'id' => $model->id], ['class' => 'delete-row',
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
        </div>
    </div>

</div>
