<?php

namespace app\models;

use yii\base\Model;

class RegisterForm extends Model
{
    public $name;
    public $email;
    public $password;
    public $password_repeat;

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['name', 'email', 'password', 'password_repeat'], 'required'],
            [['name', 'email', 'password'], 'string', 'max' => 256],
            [['name'], 'match', 'pattern' => '/^([a-zA-Z]|\d|-)+$/'],
            /*
            ['login', 'match', 'pattern' => '/^([а-яА-Я]|ё|Ё| |-)+$/'],
            */
            [['email'], 'unique', 'targetClass' => Users::class],
            ['email', 'email'],
            ['password', 'string', 'min' => 6],
            ['password_repeat', 'compare', 'compareAttribute' => 'password']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'name' => 'Имя',
            'email' => 'E-mail',
            'password' => 'Пароль',
            'password_repeat' => 'Повторите пароль',
        ];
    }
}
