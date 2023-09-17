<?php

namespace app\models;

use Yii;
use yii\helpers\VarDumper;

/**
 * This is the model class for table "mark".
 *
 * @property int $id
 * @property int $student_id
 * @property int $lesson_id
 * @property string $mark
 *
 * @property Schedule $lesson
 * @property Student $student
 */
class Mark extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mark';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['student_id', 'lesson_id', 'mark'], 'required'],
            [['student_id', 'lesson_id'], 'integer'],
            [['mark'], 'string', 'max' => 255],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => Student::class, 'targetAttribute' => ['student_id' => 'id']],
            [['lesson_id'], 'exist', 'skipOnError' => true, 'targetClass' => Schedule::class, 'targetAttribute' => ['lesson_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'student_id' => 'Student ID',
            'lesson_id' => 'Lesson ID',
            'mark' => 'Mark',
        ];
    }

    /**
     * Gets query for [[Lesson]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLesson()
    {
        return $this->hasOne(Schedule::class, ['id' => 'lesson_id']);
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

    public static function getMarkList()
    {
        return static::find()
            ->join('LEFT JOIN','schedule','schedule.id = mark.lesson_id')
            ->join('LEFT JOIN','student','student.id = mark.student_id')
            ->select(['mark', "day(`date`) as `date`", 'user_id', 'mark.lesson_id'])
            ->asArray()
            ->all();
    }

    public static function getMark($student_id, $date, $lesson_id)
    {
        return static::find()
            ->select(['mark', 'mark.id'])
            ->leftJoin('schedule','schedule.id = mark.lesson_id')
            ->leftJoin('student','student.id = mark.student_id')            
            ->where(['user_id' => $student_id])
            ->andWhere(['date' => $date])
            ->andWhere(['schedule.id' => $lesson_id])
            ->asArray()
            ->all();

    }

    public static function getAverageMark($student_id, $data, $subject) 
    {
        $month = strtok($data, " ");
        $year =  mb_substr($data, mb_strpos($data, ' '));
        
        return static::find()
        ->select('mark')
        ->leftJoin('schedule','schedule.id = mark.lesson_id')
        ->leftJoin('student','student.id = mark.student_id') 
        ->leftJoin('subject_user','subject_user.id = schedule.subject_user_id')  
        ->leftJoin('subject_name','subject_name.id = subject_user.subject_name_id')
        ->where(['student_id' => $student_id])
        ->andWhere(["monthname(`date`)" => $month])
        ->andWhere(["year(`date`)" => $year])
        ->andWhere(['title' => $subject])
        ->andWhere("mark REGEXP '^[0-9]+$'")
        ->column();
    }

    public static function getAverageAttendance($student_id, $data, $subject) 
    {
        $month = strtok($data, " ");
        $year =  mb_substr($data, mb_strpos($data, ' '));

        return static::find()
            ->select('mark')
            ->leftJoin('schedule','schedule.id = mark.lesson_id')
            ->leftJoin('student','student.id = mark.student_id') 
            ->leftJoin('subject_user','subject_user.id = schedule.subject_user_id')  
            ->leftJoin('subject_name','subject_name.id = subject_user.subject_name_id')
            ->where(['student_id' => $student_id])
            ->andWhere(["monthname(`date`)" => $month]) 
            ->andWhere(["year(`date`)" => $year])
            ->andWhere(['title' => $subject])
            ->andWhere(['mark' => 'н'])
            ->column();

    }

}
