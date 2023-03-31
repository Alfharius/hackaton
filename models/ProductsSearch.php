<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Products;

/**
 * ProductsSearch represents the model behind the search form of `app\models\Products`.
 */
class ProductsSearch extends Products
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'category', 'price', 'count'], 'integer'],
            [['name', 'year', 'img', 'country', 'model', 'created_at'], 'safe'],
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
     * @param array|null $params
     *
     * @return ActiveDataProvider
     */
    public function search(array $params = null): ActiveDataProvider
    {
        $query = Products::find();

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
        if ($this->category != 0) {
            // grid filtering conditions
            $query->andFilterWhere([
                'id' => $this->id,
                'category' => $this->category,
                'price' => $this->price,
                'count' => $this->count,
                'created_at' => $this->created_at,
            ]);

            $query->andFilterWhere(['like', 'name', $this->name])
                ->andFilterWhere(['like', 'year', $this->year])
                ->andFilterWhere(['like', 'img', $this->img])
                ->andFilterWhere(['like', 'country', $this->country])
                ->andFilterWhere(['like', 'model', $this->model]);
        }

        $query->andWhere('count > 0')
            ->orderBy(['created_at' => SORT_DESC]);

        return $dataProvider;
    }
}
