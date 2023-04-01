<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "thematics".
 *
 * @property int $id
 * @property string $hash
 *
 * @property IntensivesThematics[] $intensivesThematics
 */
class Uploads extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'uploads';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hash'], 'required'],
            [['hash'], 'string', 'max' => 256],
        ];
    }

    /**
     * {@inheritdoc}
     * @return UploadsQuery() the active query used by this AR class.
     */
    public static function find()
    {
        return new UploadsQuery(get_called_class());
    }
}
