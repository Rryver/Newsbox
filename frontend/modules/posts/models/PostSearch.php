<?php

namespace app\modules\posts\models;

use app\modules\posts\models\Post;
use yii\data\ActiveDataProvider;

class PostSearch extends Post
{
    public $inputTitle;


    public function rules()
    {
        return [
            [['inputTitle'], 'trim'],
            [['inputTitle'], 'string', 'max' => 255],
        ];
    }


    public function search()
    {
        $query = Post::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);


        $query->andFilterWhere([
            'title' => $this->title,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title]);

//        $dataProvider->sort

        return $dataProvider;
    }
}