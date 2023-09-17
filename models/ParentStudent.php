<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "parent_student".
 *
 * @property int $id
 * @property int $user_id
 * @property int $student_id
 *
 * @property Student $student
 * @property User $user
 */
class ParentStudent extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'parent_student';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'student_id'], 'required'],
            [['user_id', 'student_id'], 'integer'],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => Student::class, 'targetAttribute' => ['student_id' => 'id']],
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
            'student_id' => 'Student ID',
        ];
    }

    /**
     * Gets query for [[Student]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(Student::class, ['id' => 'student_id']);
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

    public static function getMyChildren()
    {
        $parent_id = Yii::$app->user->id;

        return static::find()
            ->join('LEFT JOIN','student','student.id = parent_student.student_id')
            ->join('LEFT JOIN','user','user.id = student.user_id')
            ->select(['name', 'patronymic', 'surname', 'student.id', 'user.id as child_id'])
            ->where(['parent_student.user_id' => $parent_id])
            ->asArray()
            ->all();
    }
}
