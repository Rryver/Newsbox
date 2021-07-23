<?php

namespace app\modules\posts\models;

use app\modules\posts\models\Post;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;

class PostSearch extends Post
{
    public $inputTitle = '';
    public $city_id = '';
    public $pages;
    public $posts;
    

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['inputTitle'], 'trim'],
            [['inputTitle'], 'string', 'max' => 255],
        ];
    }

    public function setInputTitle($inputTitle) 
    {
        if (isset($inputTitle)) {
            $this->inputTitle = $inputTitle;
        }
    }
    
    public function setCity($selectedCity)
    {
        if (isset($selectedCity)) {
            $this->city_id = $selectedCity;
        }

        if ($selectedCity == 0) {
            $this->city_id = '';
        }
    }

    /**
     * @param $query
     * @return bool
     */
    public function search($query)
    {
        $this->pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 5]);
        $this->posts = $query->offset($this->pages->offset)
            ->limit($this->pages->limit)
            ->orderBy(['id' => SORT_DESC])
            ->all();

        return true;
    }
}