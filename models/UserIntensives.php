<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_intensives".
 *
 * @property int $user_id
 * @property int $intensive_id
 *
 * @property Intensives $intensive
 * @property Users $user
 */
class UserIntensives extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_intensives';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'intensive_id'], 'required'],
            [['user_id', 'intensive_id'], 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['intensive_id'], 'exist', 'skipOnError' => true, 'targetClass' => Intensives::className(), 'targetAttribute' => ['intensive_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'intensive_id' => 'Intensive ID',
        ];
    }

    /**
     * Gets query for [[Intensive]].
     *
     * @return \yii\db\ActiveQuery|IntensivesQuery
     */
    public function getIntensive()
    {
        return $this->hasOne(Intensives::className(), ['id' => 'intensive_id']);
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
     * @return UserIntensivesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserIntensivesQuery(get_called_class());
    }
}
