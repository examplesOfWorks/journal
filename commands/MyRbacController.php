<?php
// разрешения через can и объединить их, назвать более обобщенно

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use Yii;
use yii\console\Controller;
use yii\console\ExitCode;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class MyRbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // создание ролей
        $student = $auth->createRole('student');
        $parent_of_student = $auth->createRole('parent_of_student');
        $teacher = $auth->createRole('teacher');
        $head_teacher = $auth->createRole('head_teacher');
        $head_of_department = $auth->createRole('head_of_department');
        $admin = $auth->createRole('admin');

        // добавление ролей в бд
        $auth->add($student);
        $auth->add($parent_of_student);
        $auth->add($teacher);
        $auth->add($head_teacher);
        $auth->add($head_of_department);
        $auth->add($admin);


        // создание разрешений
        $canViewMarksAndAttendance = $auth->createPermission('canViewMarksAndAttendance');
        $canViewMarksAndAttendance->description = 'Просмотр оценок и посещаемости';

        $canTeaching = $auth->createPermission('canTeaching');
        $canTeaching->description = 'Преподавательская деятельность';

        $canAddInfo = $auth->createPermission('canAddInfo');
        $canAddInfo->description = 'Размещение расписания звонков, учебных занятий и справочной информации';

        $canManageProcess = $auth->createPermission('canManageProcess');
        $canManageProcess->description = 'Ведение организации учебного процесса';

        $canAdmin = $auth->createPermission('canAdmin');
        $canAdmin->description = 'Администрирование системы';

        // добавление разрешений
        $auth->add($canViewMarksAndAttendance);
        $auth->add($canTeaching);
        $auth->add($canAddInfo);
        $auth->add($canManageProcess);
        $auth->add($canAdmin);

        // выдача ролям разрешений
        $auth->addChild($student, $canViewMarksAndAttendance);
        $auth->addChild($parent_of_student, $canViewMarksAndAttendance);
        $auth->addChild($teacher, $canTeaching);
        $auth->addChild($head_teacher, $canAddInfo);
        $auth->addChild($head_teacher, $canManageProcess);
        $auth->addChild($head_of_department, $canManageProcess);
        $auth->addChild($admin, $canAdmin);

        $auth->addChild($admin, $head_teacher);        

        // назначение ролей пользователям
        $auth->assign($student, 6);
        $auth->assign($parent_of_student, 5);
        $auth->assign($teacher, 4);
        $auth->assign($head_of_department, 3);
        $auth->assign($head_teacher, 2);
        $auth->assign($admin, 1);
        
    }
}