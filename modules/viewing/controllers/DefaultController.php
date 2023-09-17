<?php

namespace app\modules\viewing\controllers;

use Yii;
use yii\web\Controller;
use app\models\Group;
use app\models\SubjectUser;
use app\models\ParentStudent;
use yii\data\ArrayDataProvider;

/**
 * Default controller for the `viewing` module
 */
class DefaultController extends ViewingAppController
{

    public function actionIndex()
    {   
        $thisRole = Yii::$app->user->identity->getRoles(Yii::$app->user->id);

        if ($thisRole == 'Студент') {
            $myGroup = Group::getGroupByStudentId(Yii::$app->user->id)[0]['title'];
            $myGroupId = Group::getGroupByStudentId(Yii::$app->user->id)[0]['id'];
            $myLessons = SubjectUser::getLessonNameByGroupId($myGroupId);

            $dataProviderLessons = new ArrayDataProvider(['allModels' => $myLessons]);

            return $this->render('index-student', compact('thisRole', 'myGroup', 'dataProviderLessons'));

        } else {

            $myChildren = ParentStudent::getMyChildren();
            $dataProviderChildren = new ArrayDataProvider(['allModels' => $myChildren]);

            return $this->render('index-parent', compact('thisRole', 'dataProviderChildren'));
        }
    }

    public function actionSubject()
    {
        $thisStudentId = (int)Yii::$app->request->get()['student_id'];
        $studentGroup = Group::getGroupByStudentId($thisStudentId)[0]['title'];
        $studentGroupId = Group::getGroupByStudentId($thisStudentId)[0]['id'];
        $studentLessons = SubjectUser::getLessonNameByGroupId($studentGroupId);

        $dataProviderLessons = new ArrayDataProvider(['allModels' => $studentLessons]);

        return $this->render('subject', compact('thisStudentId', 'studentGroup', 'dataProviderLessons'));
    }
}
