<?php

namespace app\modules\posts\controllers;

use app\modules\posts\models\Favourite;
use app\modules\posts\models\Image;
use app\modules\posts\models\Post;
use app\modules\posts\models\PostSearch;
use yii\helpers\Url;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;

class PostController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'post-edit'],
                'rules' => [
                    [
                        'actions' => ['index', 'post-edit'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $query = Post::find()->where(['id' => Favourite::getUserFavouritePosts()]);
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 5]);
        $posts = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy(['id' => SORT_DESC])
            ->all();

        return $this->render('index', [
            'pages' => $pages,
            'posts' => $posts,
        ]);
    }

    public function actionPosts()
    {
        $postSearch = new PostSearch();

        $selectedCity = Yii::$app->request->post('selectedCity');
        if (isset($selectedCity)) {
            Yii::$app->session->set('selectedCity', $selectedCity);
        }
        $postSearch->setCity(Yii::$app->session->get('selectedCity', ''));

        if (Yii::$app->request->isPjax || Yii::$app->request->isAjax) {
            $postSearch->setInputTitle(Yii::$app->request->post('postSearch'));
            if ($postSearch->validate()) {
                $query = Post::find()->where(['like', 'title', $postSearch->inputTitle])->andWhere(['like', 'city_id', $postSearch->city_id]);
            } else {
                $query = Post::find()->where(['like', 'city_id', $postSearch->city_id]);
            }
        } else {
            $query = Post::find()->where(['like', 'city_id', $postSearch->city_id]);
        }

        $postSearch->search($query);

        return $this->render('posts', [
            'posts' => $postSearch->posts,
            'pages' => $postSearch->pages,
        ]);
    }

    /**
     * @param int $id Post id
     * @return string
     */
    public function actionPostsSimilar($categoryId)
    {
        $query = Post::find()->where(['category_id' => $categoryId]);
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 5]);
        $posts = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy(['id' => SORT_DESC])
            ->all();

        return $this->render('posts-similar', [
            'posts' => $posts,
            'pages' => $pages,
        ]);
    }

    /**
     * @param int $id Post id
     * @return string|\yii\web\Response
     */
    public function actionPost($id)
    {
        $post = Post::findOne($id);
        if (!isset($post)) {
            return $this->goBack(Yii::$app->request->referrer);
        }

        if (Favourite::find()->where(['post_id' => $post->id])->andWhere(['user_id' => Yii::$app->user->id])->one() !== null) {
            $isPostInFavourite = true;
        } else {
            $isPostInFavourite = false;
        }

        return $this->render('post', [
            'post' => $post,
            'isPostInFavourite' => $isPostInFavourite,
        ]);
    }


    public function actionFavourite($postId, $isPostInFavourite)
    {
        $favouriteModel = new Favourite();

        if ($isPostInFavourite) {
            if ($favouriteModel->removeFromFavourite($postId)) {
                Yii::$app->session->setFlash('success', 'Post was successfully removed from your favourite list');
            }
        } else {
            $favouriteModel->post_id = $postId;
            $favouriteModel->user_id = Yii::$app->user->id;
            if ($favouriteModel->save()) {
                Yii::$app->session->setFlash('success', 'Post was successfully added to your favourite list');
            }
        }

        return $this->redirect(Url::to(['/posts/post/post', 'id' => $postId]));
    }

    public function actionPostCreate()
    {
        $post = new Post();
        $image = new Image();

        if ($post->load(Yii::$app->request->post())) {
            $image->imageFile = UploadedFile::getInstance($image, 'imageFile');
            if ($post->city_id == null) {
                $post->city_id = 0;
            }
            if ($image->save()) {
                $post->image_preview_id = $image->id;
            } else {
                Yii::$app->session->setFlash('warning', 'Something goes wrong while uploading image');
            }


            $post->setUserId(Yii::$app->user->id);
            if ($post->save()) {
                return $this->redirect(Url::to(['/posts/post/post', 'id' => $post->id]));
            }
        }

        return $this->render('post-edit', [
            'post' => $post,
            'image' => $image,
        ]);
    }

}
