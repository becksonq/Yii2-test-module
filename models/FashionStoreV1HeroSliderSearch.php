<?php

namespace frontend\themes\createx\modules\fashion_store_v1_hero_slider\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\themes\createx\modules\fashion_store_v1_hero_slider\models\FashionStoreV1HeroSlider;

/**
 * FashionStoreV1HeroSliderSearch represents the model behind the search form of `frontend\themes\createx\modules\fashion_store_v1_hero_slider\models\FashionStoreV1HeroSlider`.
 */
class FashionStoreV1HeroSliderSearch extends FashionStoreV1HeroSlider
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['hero_name', 'description', 'slider_items'], 'safe'],
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
        $query = FashionStoreV1HeroSlider::find();

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
            'id' => $this->id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'hero_name', $this->hero_name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'slider_items', $this->slider_items]);

        return $dataProvider;
    }
}
