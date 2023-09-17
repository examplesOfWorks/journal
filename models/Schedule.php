<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "schedule".
 *
 * @property int $id
 * @property int $subject_user_id
 * @property string $date
 * @property int $lesson_number
 *
 * @property Mark[] $marks
 * @property SubjectUser $subjectUser
 */
class Schedule extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'schedule';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['subject_user_id', 'date', 'lesson_number'], 'required'],
            [['subject_user_id', 'lesson_number'], 'integer'],
            [['date'], 'safe'],
            [['subject_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => SubjectUser::class, 'targetAttribute' => ['subject_user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'subject_user_id' => 'Subject User ID',
            'date' => 'Date',
            'lesson_number' => 'Lesson Number',
        ];
    }

    /**
     * Gets query for [[Marks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMarks()
    {
        return $this->hasMany(Mark::class, ['lesson_id' => 'id']);
    }

    /**
     * Gets query for [[SubjectUser]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubjectUser()
    {
        return $this->hasOne(SubjectUser::class, ['id' => 'subject_user_id']);
    }

    public static function getDateList($teacher_id, $subject_name_id, $group_id)
    {
        return static::find()
        ->join('LEFT JOIN','subject_user','subject_user.id = schedule.subject_user_id')
        ->select(['date', 'schedule.id', 'lesson_number', "CONCAT (day(`date`), '.', month(`date`), '.', year(`date`), ' (', lesson_number, 'ур.)') AS lesson"])
        ->where(['user_id' => $teacher_id])
        ->andWhere(['subject_name_id' => $subject_name_id])
        ->andWhere(['group_id' => $group_id])
        ->orderBy('date asc, lesson_number asc')
        ->asArray()
        ->all();
    }

    public static function getDateListViewing($subject_name_id, $group_id)
    {
        return static::find()
            ->join('LEFT JOIN','subject_user','subject_user.id = schedule.subject_user_id')
            ->join('LEFT JOIN','subject_name','subject_name.id = subject_user.subject_name_id')
            ->select(['date', 'schedule.id', 'lesson_number', "CONCAT (day(`date`), '.', month(`date`), '.', year(`date`), ' (', lesson_number, 'ур.)') AS lesson"]) 
            ->where(['subject_name.id' => $subject_name_id])
            ->andWhere(['group_id' => $group_id])
            ->asArray()
            ->all();
    }


    public static function getDatesNumber($teacher_id, $subject_name_id, $group_id, $data)
    {
        $month = strtok($data, " ");
        $year =  mb_substr($data, mb_strpos($data, ' '));
        return static::find()
        ->join('LEFT JOIN','subject_user','subject_user.id = schedule.subject_user_id')
        ->select(['date']) 
        ->where(['user_id' => $teacher_id])
        ->andWhere(['subject_name_id' => $subject_name_id])
        ->andWhere(['group_id' => $group_id])
        ->andWhere(["monthname(`date`)" => $month])
        ->andWhere(["year(`date`)" => $year])
        ->column();
    }

    
}
