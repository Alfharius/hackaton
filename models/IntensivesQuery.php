<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Intensives]].
 *
 * @see Intensives
 */
class IntensivesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Intensives[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Intensives|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
