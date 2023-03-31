<?php

namespace app\models;

use yii\base\Model;

class RegisterForm extends Model
{
    public $name;
    public $surname;
    public $patronymic;
    public $login;
    public $email;
    public $password;
    public $password_repeat;
    public $rules;

    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['name', 'surname', 'login', 'email', 'password', 'password_repeat'], 'required'],
            [['name', 'surname', 'patronymic', 'login', 'email', 'password'], 'string', 'max' => 256],
            [['name', 'surname', 'patronymic'], 'match', 'pattern' => '/^([а-яА-Я]|ё|Ё| |-)+$/'],
            ['login', 'match', 'pattern' => '/^([a-zA-Z]|\d|-)+$/'],
            [['login', 'email'], 'unique', 'targetClass' => Users::class],
            ['email', 'email'],
            ['password', 'string', 'min' => 6],
            ['password_repeat', 'compare', 'compareAttribute' => 'password'],
            ['rules', 'compare', 'compareValue' => '1', 'message'=>'Is required']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'surname' => 'Surname',
            'patronymic' => 'Patronymic',
            'login' => 'Login',
            'email' => 'Email',
            'password' => 'Password',
            'role' => 'Role',
        ];
    }
}
