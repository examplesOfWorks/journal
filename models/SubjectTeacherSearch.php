<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Subject;

/**
 * SubjectTeacherSearch represents the model behind the search form of `app\models\Subject`.
 */
class SubjectTeacherSearch extends Subject
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['subject_id', 'organization_id', 'subject_name_id', 'user_id'], 'integer'],
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
        $query = Subject::find()->where('user_id=' . Yii::$app->user->id);

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
            'subject_id' => $this->subject_id,
            'subject_name_id' => $this->subject_name_id,
            'user_id' => $this->user_id,
        ]);

        return $dataProvider;
    }
}
