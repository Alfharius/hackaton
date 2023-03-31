<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "intensives".
 *
 * @property int $id
 * @property int $name
 * @property string $decription
 * @property int $lector_id
 *
 * @property IntensivesThematics[] $intensivesThematics
 * @property Users $lector
 * @property Schedules[] $schedules
 * @property UserIntensives[] $userIntensives
 * @property UsersFormsIntensives[] $usersFormsIntensives
 */
class Intensives extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'intensives';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'decription', 'lector_id'], 'required'],
            [['name', 'lector_id'], 'integer'],
            [['decription'], 'string'],
            [['lector_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['lector_id' => 'id']],
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
            'decription' => 'Decription',
            'lector_id' => 'Lector ID',
        ];
    }

    /**
     * Gets query for [[IntensivesThematics]].
     *
     * @return \yii\db\ActiveQuery|IntensivesThematicsQuery
     */
    public function getIntensivesThematics()
    {
        return $this->hasMany(IntensivesThematics::className(), ['intensive_id' => 'id']);
    }

    /**
     * Gets query for [[Lector]].
     *
     * @return \yii\db\ActiveQuery|UsersQuery
     */
    public function getLector()
    {
        return $this->hasOne(Users::className(), ['id' => 'lector_id']);
    }

    /**
     * Gets query for [[Schedules]].
     *
     * @return \yii\db\ActiveQuery|SchedulesQuery
     */
    public function getSchedules()
    {
        return $this->hasMany(Schedules::className(), ['intensive_id' => 'id']);
    }

    /**
     * Gets query for [[UserIntensives]].
     *
     * @return \yii\db\ActiveQuery|UserIntensivesQuery
     */
    public function getUserIntensives()
    {
        return $this->hasMany(UserIntensives::className(), ['intensive_id' => 'id']);
    }

    /**
     * Gets query for [[UsersFormsIntensives]].
     *
     * @return \yii\db\ActiveQuery|UsersFormsIntensivesQuery
     */
    public function getUsersFormsIntensives()
    {
        return $this->hasMany(UsersFormsIntensives::className(), ['intensive_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return IntensivesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new IntensivesQuery(get_called_class());
    }
}
