<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "subject_name".
 *
 * @property int $id
 * @property string $title
 *
 * @property SubjectUser $subjectUser
 */
class SubjectName extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subject_name';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
        ];
    }

    /**
     * Gets query for [[SubjectUser]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubjectUser()
    {
        return $this->hasOne(SubjectUser::class, ['subject_name_id' => 'id']);
    }

    public static function getSubjectListFromTeacher($id)
    {
        return static::find()
            ->join('LEFT JOIN', 'subject_user', 'subject_user.subject_name_id = subject_name.id')
            ->select(['title', 'subject_name.id'])
            ->where(['user_id' => $id])
            ->groupBy(['subject_name_id'])
            ->asArray()
            ->all();
    }

    public static function getSubjectNameById($id) 
    {
        return static::find()
            ->select(['title'])
            ->where(['id' => $id])
            ->column();
    }

    public static function getSubjectNameList() 
    {
        return static::find()
            ->select(['title'])
            ->indexBy('id')
            ->column();
    }
}
