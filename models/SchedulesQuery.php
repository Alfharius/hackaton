<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Schedules]].
 *
 * @see Schedules
 */
class SchedulesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Schedules[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Schedules|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
