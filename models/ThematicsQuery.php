<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Thematics]].
 *
 * @see Thematics
 */
class ThematicsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Thematics[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Thematics|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
