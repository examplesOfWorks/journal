<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SubjectUser;

/**
 * NewSubjectUserSearch represents the model behind the search form of `app\models\SubjectUser`.
 */
class NewSubjectUserSearch extends SubjectUser
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'subject_name_id', 'user_id', 'group_id'], 'integer'],
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
        // $query = SubjectUser::find();
        if (Yii::$app->user->identity->getRoles(Yii::$app->user->identity->id) ==  'Заведующий отделением') {
            $query = SubjectUser::find()
                ->leftJoin('group','group.id = subject_user.group_id')
                ->leftJoin('specialty','specialty.id = group.specialty_id')
                ->leftJoin('department','department.id = specialty.department_id') 
                ->where(['department.user_id' => Yii::$app->user->id]);
        } else {
            $query = SubjectUser::find();
        }

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
            'subject_name_id' => $this->subject_name_id,
            'user_id' => $this->user_id,
            'group_id' => $this->group_id,
        ]);

        return $dataProvider;
    }
}
