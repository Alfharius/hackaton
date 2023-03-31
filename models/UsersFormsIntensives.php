<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users_forms_intensives".
 *
 * @property int $user_id
 * @property int $form_id
 * @property int $intensive_id
 *
 * @property Forms $form
 * @property Intensive $intensive
 * @property Users $user
 */
class UsersFormsIntensives extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users_forms_intensives';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'form_id', 'intensive_id'], 'required'],
            [['user_id', 'form_id', 'intensive_id'], 'integer'],
            [['form_id'], 'exist', 'skipOnError' => true, 'targetClass' => Forms::className(), 'targetAttribute' => ['form_id' => 'id']],
            [['intensive_id'], 'exist', 'skipOnError' => true, 'targetClass' => Intensive::className(), 'targetAttribute' => ['intensive_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'form_id' => 'Form ID',
            'intensive_id' => 'Intensive ID',
        ];
    }

    /**
     * Gets query for [[Form]].
     *
     * @return \yii\db\ActiveQuery|FormsQuery
     */
    public function getForm()
    {
        return $this->hasOne(Forms::className(), ['id' => 'form_id']);
    }

    /**
     * Gets query for [[Intensive]].
     *
     * @return \yii\db\ActiveQuery|IntensivesQuery
     */
    public function getIntensive()
    {
        return $this->hasOne(Intensive::className(), ['id' => 'intensive_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|UsersQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return UsersFormsIntensivesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UsersFormsIntensivesQuery(get_called_class());
    }
}
