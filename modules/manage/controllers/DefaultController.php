<?php

namespace app\modules\manage\controllers;

use Yii;
use yii\web\Controller;
use app\models\Department;
use app\models\Group;

/**
 * Default controller for the `manage` module
 */
class DefaultController extends ManageAppController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $myDepartment = null;
        
        if (Yii::$app->user->identity->getRoles(Yii::$app->user->identity->id) ==  'Заведующий отделением') {
            $user_id = Yii::$app->user->id;
            $myDepartment = Department::getDepartmentByUserId($user_id);
            $groupList = Group::getGroupListByDepartment($myDepartment);
            return $this->render('index', compact('myDepartment', 'groupList'));
        } else {
            return $this->render('index');
        }
        
    }
}
