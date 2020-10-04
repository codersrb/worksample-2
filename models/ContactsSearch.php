<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Contacts;

/**
 * ContactsSearch represents the model behind the search form of `app\models\Contacts`.
 */
class ContactsSearch extends Contacts
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pkContactID', 'contactProjectTypeID', 'contactContactTypeID', 'contactStatusID', 'contactSourceID'], 'integer'],
            [['contactType', 'contactAddress', 'contactAddress2', 'contactCity', 'contactState', 'contactZip', 'contactCountry', 'contactBillingAddressType', 'contactBillingAddress', 'contactBillingAddress2', 'contactBillingCity', 'contactBillingState', 'contactBillingZip', 'contactBillingCountry', 'contactOpportunityTitle', 'contactPropertyAddress', 'contactPropertyCity', 'contactPropertyState', 'contactPropertyCountry', 'contactContractor', 'contactReferral', 'contactAdded', 'contactModified', 'contactPersonPhone', 'contactPersonEmail'], 'safe'],
            [['contactPersonFullName', 'tagIDs', 'fkReferredBy'], 'safe'],
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
        $query = Contacts::find();

        // add conditions that should always apply here

        $query->select(['contacts.*', 'contactPersonFullName', 'contactPersonPhone', 'contactPersonEmail', 'contactTypeName', 'contactSourceName', 'fkReferredBy']);
        $query->joinWith('contactPersons');
        $query->joinWith('contactContactType');
        $query->joinWith('contactSource');
        $query->joinWith('contactTags.fkTag');
        $query->joinWith('contactReferrals0');
        $query->groupBy('pkContactID');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['contactAdded' => SORT_DESC],
                'attributes' => ['contactPersonFullName', 'contactPersonPhone', 'contactPersonEmail', 'contactTypeName', 'contactType', 'contactAddress', 'contactAddress2', 'contactCity', 'contactAdded', 'fkReferredBy']
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
            'pkContactID' => $this->pkContactID,
            'contactProjectTypeID' => $this->contactProjectTypeID,
            'contactContactTypeID' => $this->contactContactTypeID,
            'contactStatusID' => $this->contactStatusID,
            'contactSourceID' => $this->contactSourceID,
            'contactAdded' => $this->contactAdded,
            'contactModified' => $this->contactModified,
            'fkReferredBy' => $this->fkReferredBy,
        ]);

        $query->andFilterWhere(['like', 'contactType', $this->contactType])
            ->orFilterWhere(['like', 'contactPersonPhone', $this->contactPersonPhone])
            ->orFilterWhere(['like', 'contactPersonEmail', $this->contactPersonEmail])
            ->orFilterWhere(['like', 'contactPersonFullName', $this->contactAddress])
            ->orFilterWhere(['like', 'contactAddress', $this->contactAddress])
            ->andFilterWhere(['like', 'contactAddress2', $this->contactAddress2])
            ->andFilterWhere(['like', 'contactCity', $this->contactCity])
            ->andFilterWhere(['like', 'contactState', $this->contactState])
            ->andFilterWhere(['like', 'contactZip', $this->contactZip])
            ->andFilterWhere(['like', 'contactCountry', $this->contactCountry])
            ->andFilterWhere(['like', 'contactBillingAddressType', $this->contactBillingAddressType])
            ->andFilterWhere(['like', 'contactBillingAddress', $this->contactBillingAddress])
            ->andFilterWhere(['like', 'contactBillingAddress2', $this->contactBillingAddress2])
            ->andFilterWhere(['like', 'contactBillingCity', $this->contactBillingCity])
            ->andFilterWhere(['like', 'contactBillingState', $this->contactBillingState])
            ->andFilterWhere(['like', 'contactBillingZip', $this->contactBillingZip])
            ->andFilterWhere(['like', 'contactBillingCountry', $this->contactBillingCountry])
            ->andFilterWhere(['like', 'contactOpportunityTitle', $this->contactOpportunityTitle])
            ->andFilterWhere(['like', 'contactPropertyAddress', $this->contactPropertyAddress])
            ->andFilterWhere(['like', 'contactPropertyCity', $this->contactPropertyCity])
            ->andFilterWhere(['like', 'contactPropertyState', $this->contactPropertyState])
            ->andFilterWhere(['like', 'contactPropertyCountry', $this->contactPropertyCountry])
            ->andFilterWhere(['like', 'contactContractor', $this->contactContractor])
            ->andFilterWhere(['like', 'contactReferral', $this->contactReferral]);

        $query->andFilterWhere(['in','fkTagID', $this->tagIDs]);
        return $dataProvider;
    }
}
