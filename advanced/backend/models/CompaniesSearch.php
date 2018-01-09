<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Companies;

/**
 * CompaniesSearch represents the model behind the search form of `backend\models\Companies`.
 */
class CompaniesSearch extends Companies
{
    public $generalSearch;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_id'], 'integer'],
            [['company_name', 'company_email', 'company_address', 'company_created_date', 'company_status', 'generalSearch'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Companies::find();

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

       

        $query->orFilterWhere(['like', 'company_name', $this->generalSearch])
            ->orFilterWhere(['like', 'company_email', $this->generalSearch])
            ->orFilterWhere(['like', 'company_address', $this->generalSearch])
            ->orFilterWhere(['like', 'company_status', $this->generalSearch]);

        return $dataProvider;
    }
}
