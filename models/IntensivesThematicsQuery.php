<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[IntensivesThematics]].
 *
 * @see IntensivesThematics
 */
class IntensivesThematicsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return IntensivesThematics[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return IntensivesThematics|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
