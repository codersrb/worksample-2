<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\User;

/**
 * UsersSearch represents the model behind the search form of `app\models\User`.
 */
class UsersSearch extends User
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pkUserID'], 'integer'],
            [['userEmail', 'userAuthKey', 'userPassword', 'userResetToken', 'userName', 'userNumber', 'userProfilePicture', 'userAdded', 'userModified', 'userRole', 'userStatus'], 'safe'],
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
        $query = User::find();

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
            'pkUserID' => $this->pkUserID,
            'userAdded' => $this->userAdded,
            'userModified' => $this->userModified,
        ]);

        $query->andFilterWhere(['like', 'userEmail', $this->userEmail])
            ->andFilterWhere(['like', 'userAuthKey', $this->userAuthKey])
            ->andFilterWhere(['like', 'userPassword', $this->userPassword])
            ->andFilterWhere(['like', 'userResetToken', $this->userResetToken])
            ->andFilterWhere(['like', 'userName', $this->userName])
            ->andFilterWhere(['like', 'userNumber', $this->userNumber])
            ->andFilterWhere(['like', 'userProfilePicture', $this->userProfilePicture])
            ->andFilterWhere(['like', 'userRole', $this->userRole])
            ->andFilterWhere(['like', 'userStatus', $this->userStatus]);

        return $dataProvider;
    }
}
