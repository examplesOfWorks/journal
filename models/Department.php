<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "department".
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 *
 * @property Specialty[] $specialties
 * @property User $user
 */
class Department extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'department';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'title'], 'required'],
            [['user_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
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
            'title' => 'Title',
        ];
    }

    /**
     * Gets query for [[Specialties]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSpecialties()
    {
        return $this->hasMany(Specialty::class, ['department_id' => 'id']);
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

    public static function getDepartmentByUserId($user_id)
    {
        return static::findOne(['user_id' => $user_id])->title;
    }

    public static function getDepartmentList()
    {
        return static::find()
            ->select(['title'])
            ->indexBy('id')
            ->column();
    }
}
