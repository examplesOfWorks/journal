<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\widgets\Pjax;
use yii\helpers\VarDumper;

/** @var yii\web\View $this */
/** @var app\models\Student $model */
/** @var yii\widgets\ActiveForm $form */
?>

<?php 
    $valuesMark = [
        0 => 1,
        1 => 2,
        2 => 3,
        3 => 4,
        4 => 5,
        5 => 'н',
        6 => 'ув.',
        7 => 'б',
    ] 

?>

<?php Pjax::begin(['enablePushState' => false, 'enableReplaceState' => false]); ?>


    <?php $form = ActiveForm::begin([
        'id' => 'mark-form',
        'options' => ['data-pjax' => true],
    ]); ?> 

 
        
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">

            <div class="ms-1">
                <?= $form->field($modelMark, 'mark')->dropDownList($valuesMark, ['prompt' => ''])->label(false) ?>

                <?= $form->field($modelMark, 'student_id')->hiddenInput(['value' => $student_id])->label(false) ?>

                <?=  $form->field($modelMark, 'lesson_id')->hiddenInput(['value' => $lesson_id])->label(false)?>
            </div>
        </div>

            <div class="me-1 col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 d-flex justify-content-end">
                <?= Html::submitButton('<i class="fa fa-check-circle-o" aria-hidden="true"></i>', ['class' => 'btn btn-light', 
                'name' => 'confirm-button', 'id' => 'agree', 'data-method' => 'post']) ?>
            </div>
        
    </div>


    <?php ActiveForm::end(); ?>

<?php Pjax::end(); ?>

