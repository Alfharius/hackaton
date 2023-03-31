<?php

namespace app\models;

use yii\base\Model;

class IntensiveRegisterForm extends Model
{
    public $phone;
    public $email;
    public $institution;
    public $about;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['phone', 'email', 'institution', 'about'], 'required'],
            // email has to be a valid email address
            [['email'], 'email'],
            [['phone', 'institution', 'about'], 'string'],
        ];
    }
}