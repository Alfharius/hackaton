<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property int $type
 */
class Users extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['name', 'email', 'password'], 'required'],
            [['type'], 'integer'],
            [['name', 'email', 'password'], 'string', 'max' => 256],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'type' => 'Type',
        ];
    }

    /**
     * {@inheritdoc}
     * @return UsersQuery the active query used by this AR class.
     */
    public static function find(): UsersQuery
    {
        return new UsersQuery(get_called_class());
    }

    public static function findIdentity($id)
    {
        return Users::findOne(['id' => $id]) ?? null;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return null;
    }

    public function validateAuthKey($authKey): bool
    {
        return true;
    }

    /**
     * Finds user by username
     *
     * @param string $email
     * @return static|null
     */
    public static function findByEmail(string $email)
    {
        return Users::findOne(['email' => $email]) ?? null;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword(string $password): bool
    {
        return Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }

    public static function isAdmin(): bool
    {
        return self::identity() && \Yii::$app->user->identity->role === 1;
    }

    public static function identity()
    {
        return \Yii::$app->user->identity;
    }

    /**
     * Gets query for [[Intensives]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIntensives()
    {
        return $this->hasMany(Intensives::className(), ['lector_id' => 'id']);
    }

    /**
     * Gets query for [[UserIntensives]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserIntensives()
    {
        return $this->hasMany(UserIntensives::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[UsersFormsIntensives]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsersFormsIntensives()
    {
        return $this->hasMany(UsersFormsIntensives::className(), ['user_id' => 'id']);
    }
}
