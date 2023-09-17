<?php

// use Yii;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\User $model */

$this->title = $model->name;

\yii\web\YiiAsset::register($this);
?>

<div class="container">
    <div class="user-view">

        <h1><?= Html::encode($this->title) ?></h1>

        <p>
            <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Вы уверены, что хотите удалить данные о пользователе?',
                    'method' => 'post',
                ],
            ]) ?>
            
        </p>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                [
                    'format' => 'raw',
                    'label' => 'ФИО пользователя',
                    'value' => function ($model) {
                        $addChild = '<div class="d-flex justify-content-end">' . Html::a('Указать детей', ['/adding/parent-student/create', 'id' => $model->id], ['class' => 'btn btn-primary']) . '</div>';
                        return Yii::$app->user->identity->getRoles($model->id) == 'Родитель'  
                            ? $model->name . ' ' . $model->patronymic . ' ' . $model->surname . $addChild : 
                            $model->name . ' ' . $model->patronymic . ' ' . $model->surname;
                    }
                ],
                [
                    'attribute' => 'gender_id',
                    'value' => function($model) {
                        return $model->gender->title;
                    }
                ],
                'login',
                'birthday',
                'residential_address',
                'registration_address',
                'email:email',
                'phone',
            ],
        ]) ?>

    </div>

</div>
