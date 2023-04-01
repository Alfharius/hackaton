<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Thematics]].
 *
 * @see Uploads
 */
class UploadsQuery extends \yii\db\ActiveQuery
{


    /**
     * {@inheritdoc}
     * @return Uploads[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Uploads|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
