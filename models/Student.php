<?php

namespace app\models;

use Yii;
use yii\helpers\VarDumper;

/**
 * This is the model class for table "student".
 *
 * @property int $id
 * @property int $user_id
 * @property int $group_id
 *
 * @property Group $group
 * @property Mark[] $marks
 * @property User $user
 */
class Student extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'student';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'group_id'], 'required'],
            [['user_id', 'group_id'], 'integer'],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Group::class, 'targetAttribute' => ['group_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'group_id' => 'Group ID',
        ];
    }

    /**
     * Gets query for [[Group]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Group::class, ['id' => 'group_id']);
    }

    /**
     * Gets query for [[Marks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMarks()
    {
        return $this->hasMany(Mark::class, ['student_id' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public static function getStudentsFormGroup($group_id)
    {
        return static::find()
            ->join('LEFT JOIN','user','user.id = student.user_id')
            ->join('LEFT JOIN','mark','mark.student_id = student.id')
            ->join('LEFT JOIN','schedule','schedule.id = mark.lesson_id')
            ->select(['user.name', 'user.patronymic', 'user.surname', 'student.id' , 'mark.mark', 'user.id', "day(date) as date"])
            ->where(['group_id' => $group_id])
            ->orderBy('user.surname asc')
            ->asArray()
            ->all();

    
    }

    public static function getThisStudent($id)
    {
        return static::find()
            ->join('LEFT JOIN','user','user.id = student.user_id')
            ->select(['user.name', 'user.patronymic', 'user.surname', 'student.id', 'user.id as user_id'])
            ->where(['student.id' => $id])
            ->asArray()
            ->all();
    }

    public static function getStudentByUserId($user_id)
    {
        return static::findOne(['user_id' => $user_id])->id;
    }

    public static function getStudentList()
    {
        return static::find()
            ->join('LEFT JOIN','user','user.id = student.user_id')
            ->select(["CONCAT(user.name, ' ', user.patronymic, ' ', user.surname) AS fio"])
            ->indexBy('student.id')
            ->column();
    }

    /**
     * Gets query for [[ParentStudents]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParentStudents()
    {
        return $this->hasMany(ParentStudent::class, ['student_id' => 'id']);
    }

}

