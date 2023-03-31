<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Schedules]].
 *
 * @see Schedule
 */
class SchedulesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Schedule[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Schedule|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
