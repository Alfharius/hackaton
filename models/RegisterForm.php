<?php

namespace app\models;

use yii\base\Model;

class RegisterForm extends Model
{
    public $name;
    public $surname;

    public $patronymic;
    public $email;
    public $password;
    public $password_repeat;
    public $checkbox;

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['name', 'surname', 'email', 'password', 'password_repeat'], 'required'],
            [['name', 'surname', 'patronymic', 'email', 'password'], 'string', 'max' => 256],
            ['checkbox', 'compare', 'compareValue'=>1],
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
            'surname' => 'Фамилия',
            'name' => 'Имя',
            'patronymic' => 'Отчество',
            'email' => 'E-mail',
            'password' => 'Пароль',
            'password_repeat' => 'Повторите пароль',
            'checkbox' => 'Я соглашаюсь с обработкой персональных данных'
        ];
    }
}
