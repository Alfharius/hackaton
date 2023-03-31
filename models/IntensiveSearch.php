<?php

namespace app\models;

use app\models\Intensive;
use yii\base\Model;
use yii\data\ActiveDataProvider;

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
            [['lector_id'], 'integer'],
            [['name'], 'string'],
            [['id', 'description'], 'safe'],
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
    public function search($params, $query = null)
    {
        $query = $query ?? Intensive::find();
        $tableName = Intensive::tableName();
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



        if (!empty($params["lectorName"])) {
            $query
                ->leftJoin('users u', "$tableName.lector_id = u.id")
                ->andWhere(['like', 'u.name', "{$params['lectorName']}"]);
        }

        if (!empty($params["thematic_id"])) {
            $query
                ->leftJoin('intensives_thematics it', "$tableName.id = it.intensive_id")
                ->leftJoin(Thematics::tableName() . ' tm', "it.thematic_id = tm.id")
                ->andWhere(['tm.id' => $params["thematic_id"]]);
        }

        $query->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }

    public function searchByUser($user_id, $params): ActiveDataProvider
    {
        $tableName = Intensive::tableName();
        $query = Intensive::find()
            ->leftJoin('users_forms_intensives ufi', "$tableName.id = ufi.intensive_id")
            ->where(['ufi.user_id' => $user_id]);
        return $this->search($params, $query);
    }
}
