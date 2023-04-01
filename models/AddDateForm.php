<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read Users|null $user
 *
 */
class AddDateForm extends Model
{
    public $startTime;
    public $endTime;
    public $name;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules(): array
    {
        return [
            [['startTime', 'endTime', 'name'], 'required']
        ];
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->user);
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return Users|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = Users::findByEmail($this->email);
        }

        return $this->_user;
    }

    public function attributeLabels(): array
    {
        return [
            'startTime' => 'Дата начала',
            'endTime' => 'Дата конца',
            'name' => 'Название'
        ];
    }
}
