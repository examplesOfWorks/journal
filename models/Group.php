<?php

namespace app\models;

use Yii;
use app\models\Department;

/**
 * This is the model class for table "group".
 *
 * @property int $id
 * @property int $specialty_id
 * @property string $title
 *
 * @property Specialty $specialty
 * @property Student[] $students
 * @property SubjectUser[] $subjectUsers
 */
class Group extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'group';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['specialty_id', 'title'], 'required'],
            [['specialty_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['specialty_id'], 'exist', 'skipOnError' => true, 'targetClass' => Specialty::class, 'targetAttribute' => ['specialty_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'specialty_id' => 'Specialty ID',
            'title' => 'Title',
        ];
    }

    /**
     * Gets query for [[Specialty]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSpecialty()
    {
        return $this->hasOne(Specialty::class, ['id' => 'specialty_id']);
    }

    /**
     * Gets query for [[Students]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudents()
    {
        return $this->hasMany(Student::class, ['group_id' => 'id']);
    }

    /**
     * Gets query for [[SubjectUsers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubjectUsers()
    {
        return $this->hasMany(SubjectUser::class, ['group_id' => 'id']);
    }

    public static function getGroupById($id) 
    {
        return static::find()
            ->select(['title'])
            ->where(['id' => $id])
            ->column();
    }

    public static function getGroupListByDepartment() 
    {
        if (Yii::$app->user->identity->getRoles(Yii::$app->user->identity->id) ==  'Заведующий отделением') {
            return static::find()
            ->join('LEFT JOIN','specialty','specialty.id = group.specialty_id')
            ->join('LEFT JOIN','department','department.id = specialty.department_id')
            ->select('group.title')
            ->where(['department.title' => Department::getDepartmentByUserId(Yii::$app->user->id)])
            ->indexBy('id')
            ->column();
        } else {
            return static::find()   
            ->select('title')
            ->indexBy('id')
            ->column();
        }
        
    } 

    public static function getGroupByStudentId($id)
        {
            return static::find()
                ->join('LEFT JOIN','student','student.group_id = group.id')
                ->select(['group.id', 'title'])
                ->where(['user_id' => $id])
                ->asArray()
                ->all();
        }
}
