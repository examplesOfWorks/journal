<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "subject_user".
 *
 * @property int $id
 * @property int $subject_name_id
 * @property int $user_id
 * @property int|null $group_id
 *
 * @property Group $group
 * @property Schedule[] $schedules
 * @property SubjectName $subjectName
 * @property User $user
 */
class SubjectUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subject_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['subject_name_id', 'user_id'], 'required'],
            [['subject_name_id', 'user_id', 'group_id'], 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['subject_name_id'], 'exist', 'skipOnError' => true, 'targetClass' => SubjectName::class, 'targetAttribute' => ['subject_name_id' => 'id']],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Group::class, 'targetAttribute' => ['group_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'subject_name_id' => 'Subject Name ID',
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
     * Gets query for [[Schedules]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSchedules()
    {
        return $this->hasMany(Schedule::class, ['subject_user_id' => 'id']);
    }

    /**
     * Gets query for [[SubjectName]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubjectName()
    {
        return $this->hasOne(SubjectName::class, ['id' => 'subject_name_id']);
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

    public static function getTeacherListForSchedule()
    {
        return static::find()
            ->leftJoin('user','user.id = subject_user.user_id')
            ->leftJoin('group','group.id = subject_user.group_id')
            ->leftJoin('subject_name','subject_name.id = subject_user.subject_name_id')
            ->select(["CONCAT(name, ' ', patronymic, ' ', surname, ' (', group.title, ') - ', subject_name.title) AS name"])
            ->indexBy('id')
            ->column();

    }

    public static function getLessonNameByGroupId($id)
    {
        return static::find()
            ->leftJoin('subject_name','subject_name.id = subject_user.subject_name_id')
            ->leftJoin('user','user.id = subject_user.user_id')
            ->select(['title', 'subject_name.id', 'user_id', 'name', 'patronymic', 'surname'])
            ->where(['group_id' => $id])
            ->asArray()
            ->all();
    }

}
