<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "intensives_thematics".
 *
 * @property int $intensive_id
 * @property int $thematic_id
 *
 * @property Intensive $intensive
 * @property Thematics $thematic
 */
class IntensivesThematics extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'intensives_thematics';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['intensive_id', 'thematic_id'], 'required'],
            [['intensive_id', 'thematic_id'], 'integer'],
            [['intensive_id'], 'exist', 'skipOnError' => true, 'targetClass' => Intensive::className(), 'targetAttribute' => ['intensive_id' => 'id']],
            [['thematic_id'], 'exist', 'skipOnError' => true, 'targetClass' => Thematics::className(), 'targetAttribute' => ['thematic_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'intensive_id' => 'Intensive ID',
            'thematic_id' => 'Thematic ID',
        ];
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
     * Gets query for [[Thematic]].
     *
     * @return \yii\db\ActiveQuery|ThematicsQuery
     */
    public function getThematic()
    {
        return $this->hasOne(Thematics::className(), ['id' => 'thematic_id']);
    }

    /**
     * {@inheritdoc}
     * @return IntensivesThematicsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new IntensivesThematicsQuery(get_called_class());
    }
}
