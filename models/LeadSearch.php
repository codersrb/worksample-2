<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Leads;

/**
 * LeadSearch represents the model behind the search form of `app\models\Leads`.
 */
class LeadSearch extends Leads
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pkLeadID', 'fkContactID'], 'integer'],
            [['leadAdded', 'leadModified'], 'safe'],
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
        $query = Leads::find();

        $query->select(['leads.*', 'contactOpportunityTitle', 'contactPersonFullName', 'contactStatusName', 'contactSourceName']);
        $query->joinWith('fkContact');
        $query->joinWith('fkContact.contactPersons');
        $query->joinWith('fkContact.contactStatus');
        $query->joinWith('fkContact.contactSource');
        $query->groupBy('pkLeadID');


        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['leadAdded' => SORT_DESC],
                'attributes' => ['contactOpportunityTitle', 'contactPersonFullName', 'contactStatusName', 'contactSourceName', 'leadAdded']
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'pkLeadID' => $this->pkLeadID,
            'fkContactID' => $this->fkContactID,
            'leadAdded' => $this->leadAdded,
            'leadModified' => $this->leadModified,
        ]);

        return $dataProvider;
    }
}
