<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Intensives]].
 *
 * @see Intensive
 */
class IntensivesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Intensive[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Intensive|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
