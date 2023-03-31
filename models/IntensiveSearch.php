<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Intensive;

/**
 * IntensiveSearch represents the model behind the search form of `app\models\Intensive`.
 */
class IntensiveSearch extends Intensive
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lector_id', 'thematic_id'], 'integer'],
            [['name'], 'string'],
            [['id', 'decription'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Intensive::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'name' => $this->name,
            'lector_id' => $this->lector_id,
        ]);

/*        if (isset($this->thematic_id)){
            $query->andWhere([]);
        }*/

        $query->andFilterWhere(['like', 'decription', $this->decription]);

        return $dataProvider;
    }
}
