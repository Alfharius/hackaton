<?php

namespace app\models;

use Yii;
use yii\base\InvalidConfigException;

/**
 * This is the model class for table "schedules".
 *
 * @property int $id
 * @property string $name
 * @property string $decsription
 * @property string $start_time
 * @property string $end_time
 * @property int $intensive_id
 *
 * @property Intensive $intensive
 */
class Schedule extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'schedules';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'start_time', 'end_time'], 'required'],
            [['start_time', 'end_time'], 'safe'],
            [['intensive_id'], 'integer'],
            [['name'], 'string', 'max' => 256],
            [['intensive_id'], 'exist', 'skipOnError' => true, 'targetClass' => Intensive::className(), 'targetAttribute' => ['intensive_id' => 'id']],
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
            'start_time' => 'Start Time',
            'end_time' => 'End Time',
            'intensive_id' => 'Intensive ID',
        ];
    }

    /**
     * @return string
     * @throws InvalidConfigException
     */
    public function getStartTime(): string
    {
       $date = date_create($this->start_time);
        return   date_format($date, 'd M Y');
    }

    /**
     * @return string
     * @throws InvalidConfigException
     */
    public function getEndTime(): string
    {
        $date = date_create($this->end_time);
        return   date_format($date, 'd M Y');
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
     * {@inheritdoc}
     * @return SchedulesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SchedulesQuery(get_called_class());
    }
}
