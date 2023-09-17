<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $user_id
 * @property int $organization_id
 * @property int $gender_id
 * @property string $name
 * @property string $surname
 * @property string|null $patronymic
 * @property string $login
 * @property string $birthday
 * @property string $residential_address
 * @property string $registration_address
 * @property string $email
 * @property string $phone
 * @property string $password
 * @property string $auth_key
 *
 * @property AuthAssignment[] $authAssignments
 * @property Department[] $departments
 * @property Gender $gender
 * @property Organization $organization
 * @property Subject[] $subjects
 */
class User extends ActiveRecord implements IdentityInterface
{
    public $role;
    public $passwordBeforeHash;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['gender_id', 'name', 'surname', 'login', 'birthday', 'residential_address', 'registration_address', 'phone', 
            'email', 'password', 'auth_key'], 'required'],
            [['gender_id'], 'integer'],
            [['birthday'], 'safe'],
            [['name', 'surname', 'patronymic','login', 'residential_address', 'registration_address', 'phone', 'registration_address', 'phone', 
            'email', 'password', 'auth_key'], 'string', 'max' => 255],
            [['phone'], 'unique'],
            [['login'], 'unique'],
            [['email'], 'unique'],
            [['gender_id'], 'exist', 'skipOnError' => true, 'targetClass' => Gender::class, 'targetAttribute' => ['gender_id' => 'id']],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => AuthAssignment::class, 'targetAttribute' => ['id' => 'user_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID пользователя',
            'role' => 'Роль',
            'gender_id' => 'Пол',
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'patronymic' => 'Отчество',
            // 'login' => 'Login',
            'birthday' => 'День рождения',
            'residential_address' => 'Адрес проживания',
            'registration_address' => 'Адрес регистрации',
            'phone' => 'Телефон',
            // 'email' => 'Email',
            // 'password' => 'Password',
            'auth_key' => 'Auth Key',
        ];
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }


    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
    }

    /**
     * @return int|string current user ID
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string|null current user auth key
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function getBeforeHash()
    {
        return $this->passwordBeforeHash;
    }

    /**
     * @param string $authKey
     * @return bool|null if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->auth_key = \Yii::$app->security->generateRandomString();
                $this->passwordBeforeHash = $this->password;
                $this->password = Yii::$app->security->generatePasswordHash($this->password);
            }
            return true;
        }
        return false;
    }

    public static function findByUsername($login) 
    {
        return static::findOne(['login' => $login]);
    }

    public static function getAll()
    {
        return static::find()->all();
    }

    public static function findByRole($role)
    {
        return static::find()
            ->join('LEFT JOIN','auth_assignment','auth_assignment.user_id = user.id')
            ->where(['auth_assignment.item_name' => $role])
            ->all();
    }

    public static function getUserByRole($role)
    {
        return static::find()
            
            ->join('LEFT JOIN','auth_assignment','auth_assignment.user_id = user.id')
            ->where(['auth_assignment.item_name' => $role])
            ->select(["CONCAT(name, ' ', patronymic, ' ', surname) AS fio"])
            ->indexBy('id')
            ->column();
    }

    public static function getUserFioById($id)
    {
        return static::find()
            ->select(["CONCAT(name, ' ', patronymic, ' ', surname) AS fio"])
            ->where(['id' => $id])
            ->indexBy('id')
            ->column();
    }

    public function getRoles($id)
    {
        $role = Yii::$app->authManager->getRolesByUser($id);
        return array_values($role)[0]->description;
    }

    /**
     * Gets query for [[AuthAssignments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthAssignments()
    {
        return $this->hasMany(AuthAssignment::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Departments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartments()
    {
        return $this->hasMany(Department::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Gender]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGender()
    {
        return $this->hasOne(Gender::class, ['id' => 'gender_id']);
    }

    /**
     * Gets query for [[Students]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudents()
    {
        return $this->hasMany(Student::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[SubjectUsers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubjectUsers()
    {
        return $this->hasMany(SubjectUser::class, ['user_id' => 'id']);
    }

     /**
     * Gets query for [[ParentStudents]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParentStudents()
    {
        return $this->hasMany(ParentStudent::class, ['user_id' => 'id']);
    }

}
