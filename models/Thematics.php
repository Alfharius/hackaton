<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "thematics".
 *
 * @property int $id
 * @property string $name
 *
 * @property IntensivesThematics[] $intensivesThematics
 */
class Thematics extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'thematics';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
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
        ];
    }

    /**
     * Gets query for [[IntensivesThematics]].
     *
     * @return \yii\db\ActiveQuery|IntensivesThematicsQuery
     */
    public function getIntensivesThematics()
    {
        return $this->hasMany(IntensivesThematics::className(), ['thematic_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return ThematicsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ThematicsQuery(get_called_class());
    }
}
