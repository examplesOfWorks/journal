<?php

use app\models\Group;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\VarDumper;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\NewGroupSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Управление группами';
// VarDumper::dump(Yii::$app->user->id, 10, true);


?>
<?php if (Yii::$app->session->hasFlash('success')): ?>
    <div class="alert alert-success alert-dismissable">
         <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
         <h4><i class="icon fa fa-check"></i>Сохранено</h4>
         <?= Yii::$app->session->getFlash('success') ?>
    </div>
<?php endif; ?>

<div class="group-index">

    <div class="section_title text-center">
        <div class="d-flex justify-content-center">
            <h3><?= Html::encode($this->title) ?></h3>
        </div>
        <?= (Yii::$app->user->identity->getRoles(Yii::$app->user->identity->id) ==  'Заведующий отделением') ?
            '<p> Группы отделения: ' . $myDepartment . '</p>' : ''?>
    </div>

    <div class="popular_program_area program__page">
        <div class="container">

            <p>
                <?= Html::a('Добавить новую группу', ['create'], ['class' => 'btn btn-primary']) ?>
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
                        'label' => 'Специальность',
                        'value' => function($model) {
                            return $model->specialty->title;
                        }
                    ],
                    [
                        'label' => 'Название группы',
                        'value' => function($model) {
                            return $model->title;
                        }
                    ],
                    // [
                    //     'class' => ActionColumn::className(),
                    //     'urlCreator' => function ($action, Group $model, $key, $index, $column) {
                    //         return Url::toRoute([$action, 'id' => $model->id]);
                    //      }
                    // ],
                    [
                        'label' => 'Действия',
                        'format' => 'raw',
                        'value' => function ($model) {
                            $btn_edit = Html::a('<i class="fa fa-pencil"></i>', ['update', 'id' => $model->id]);
                            $btn_delete = Html::a('<i class="fa fa-trash"></i>', ['delete', 'id' => $model->id], ['class' => 'delete-row',
                                'data' => [
                                    'confirm' => 'Вы уверены, что хотите удалить группу?',
                                    'method' => 'post',
                                ]]);
                            return '<div class="actions">' . $btn_edit . ' ' . $btn_delete . '</div>';
                        }
                    ],
                ],
            ]); ?>

            <?php Pjax::end(); ?>
        </div>
    </div>
</div>
