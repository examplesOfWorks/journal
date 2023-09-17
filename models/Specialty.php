<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "specialty".
 *
 * @property int $id
 * @property int $department_id
 * @property string $title
 *
 * @property Department $department
 * @property Group[] $groups
 */
class Specialty extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'specialty';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['department_id', 'title'], 'required'],
            [['department_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => Department::class, 'targetAttribute' => ['department_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'department_id' => 'Department ID',
            'title' => 'Title',
        ];
    }

    /**
     * Gets query for [[Department]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Department::class, ['id' => 'department_id']);
    }

    /**
     * Gets query for [[Groups]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroups()
    {
        return $this->hasMany(Group::class, ['specialty_id' => 'id']);
    }

    public static function getSpecialtyList()
    {
        if (Yii::$app->user->identity->getRoles(Yii::$app->user->identity->id) ==  'Заведующий отделением') {
            return static::find()
            ->leftJoin('department','department.id = specialty.department_id')     
            ->select('specialty.title')
            ->where(['department.user_id' => Yii::$app->user->id])
            ->indexBy('id')
            ->column();
        } else {
            return static::find()   
            ->select('title')
            ->indexBy('id')
            ->column();
        }
        
    }
}
