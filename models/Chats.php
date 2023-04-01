<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "chats".
 *
 * @property int $id
 * @property int|null $intensive_id
 * @property int|null $user_id
 *
 * @property Intensives $intensive
 * @property Messages[] $messages
 * @property Users $user
 */
class Chats extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'chats';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['intensive_id', 'user_id'], 'integer'],
            [['intensive_id'], 'exist', 'skipOnError' => true, 'targetClass' => Intensive::class, 'targetAttribute' => ['intensive_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'intensive_id' => 'Intensive ID',
            'user_id' => 'User ID',
        ];
    }

    /**
     * Gets query for [[Intensive]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIntensive()
    {
        return $this->hasOne(Intensives::class, ['id' => 'intensive_id']);
    }

    /**
     * Gets query for [[Messages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMessages()
    {
        return $this->hasMany(Messages::class, ['chat_id' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::class, ['id' => 'user_id']);
    }

    public function upload(): bool
    {
        $file = UploadedFile::getInstance($this, 'img');
        if (!empty($file)) {
            if ($this->validate()){
                $name = Yii::$app->security->generateRandomString(32) . '.' . $this->img->extension;
                if ($file->saveAs(Yii::$app->basePath.'/web/uploads/' . $name)){

                    $this->img = $name;
                    return true;
                }
            }
        } else {
            //TODO генерировать из текста и цвета
            return true;
        }

        return false;
    }
}
