<?php

namespace app\models;
use yii\helpers\VarDumper;

use Yii;
use yii\base\Model;
// use yii\swiftmailer\Mailer;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

/**
 * ContactForm is the model behind the contact form.
 */
class RegisterForm extends Model
{
    public $role;
    public $gender_id;
    public $name;
    public $surname;
    public $patronymic;
    public $login;
    public $birthday;
    public $residential_address;
    public $registration_address; 
    public $email;
    public $phone;
    public $password;
    public $password_repeat;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['role', 'gender_id', 'name', 'surname', 'login', 'birthday', 'residential_address', 'registration_address', 'phone', 
            'email', 'password'], 'required'],
            [['gender_id'], 'integer'],
            [['birthday'], 'safe'],
            [['role', 'name', 'surname', 'patronymic', 'login', 'residential_address', 'registration_address', 'phone', 'email', 
            'password'], 'string', 'max' => 255],
            [['password', 'password_repeat'], 'string', 'min' => 6],
            ['password_repeat', 'compare', 'compareAttribute' => 'password'],
            [['login', 'email', 'phone'], 'unique', 'targetClass' => User::class],
            ['email', 'email'],
            [['gender_id'], 'exist', 'skipOnError' => true, 'targetClass' => Gender::class, 'targetAttribute' => ['gender_id' => 'id']],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'role' => 'Роль',
            'gender_id' => 'Пол',
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'patronymic' => 'Отчество',
            'login' => 'Логин',
            'birthday' => 'Дата рождения',
            'residential_address' => 'Адрес проживания',
            'registration_address' => 'Адрес регистрации',
            'phone' => 'Телефон',
            'email' => 'Email',
            'password' => 'Пароль',
            'password_repeat' => 'Повторите пароль',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */
    public function registerUser()
    {
        if ($this->validate()) {
            
            $user = new User;
            
            if ($user->load($this->attributes, '')) {
                $user->save(false);

                $data = [
                    'name' => $user->name, 
                    'login' => $user->login,
                    'password' => $user->passwordBeforeHash,
                ];

                Yii::$app->mailer->htmlLayout = 'layouts/html';

                Yii::$app->mailer
                    ->compose('mail', compact('data'))
                    ->setFrom('an.br1@mail.ru')
                    ->setTo($user->email)
                    ->setSubject('Данные для авторизации')
                    ->send();
                    
                if ($this->role) {
                    $auth = Yii::$app->authManager;
                    $userRole = $auth->getRole($this->role);
                    $auth->assign($userRole, $user->getId());
                }
            }
            return $user;
        }
    }
}