<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "forms".
 *
 * @property int $id
 * @property string $name
 * @property string $fields
 *
 * @property UsersFormsIntensives[] $usersFormsIntensives
 */
class Forms extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'forms';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'fields'], 'required'],
            [['fields'], 'safe'],
            [['name'], 'string', 'max' => 256],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'fields' => 'Fields',
        ];
    }

    /**
     * Gets query for [[UsersFormsIntensives]].
     *
     * @return \yii\db\ActiveQuery|UsersFormsIntensivesQuery
     */
    public function getUsersFormsIntensives()
    {
        return $this->hasMany(UsersFormsIntensives::className(), ['form_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return FormsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FormsQuery(get_called_class());
    }
}
