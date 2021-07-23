<?php

namespace app\modules\posts\controllers;

use app\modules\posts\models\Image;
use app\modules\posts\models\Post;
use app\modules\posts\models\PostSearch;
use yii\helpers\Url;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
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
        return $this->render('index');
    }

    public function actionPosts()
    {
        if (Yii::$app->request->isPjax || Yii::$app->request->isAjax) {
            $str = Yii::$app->request->post('postSearch');
            if (!empty($str)) {
                $query = Post::find()->where(['like', 'title', $str]);
            } else {
                $query = Post::find();
            }
            $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 5]);
            $posts = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->orderBy(['id' => SORT_DESC])
                ->all();

            return $this->render('posts', [
                'posts' => $posts,
                'pages' => $pages,
            ]);
        }

        $query = Post::find();
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 5]);
        $posts = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy(['id' => SORT_DESC])
            ->all();


        return $this->render('posts', [
            'posts' => $posts,
            'pages' => $pages,
        ]);
    }

    public function actionPostsSearch()
    {

        $postSearch = new PostSearch();
        //$postSearch->inputTitle;

    }

    public function actionPost($id)
    {
        $post = Post::findOne($id);


        if (!isset($post)) {
            return $this->goBack(Yii::$app->request->referrer);
        }

        return $this->render('post', [
            'post' => $post,
        ]);
    }

    public function actionPostCreate()
    {
        $post = new Post();
        $image = new Image();

        if ($post->load(Yii::$app->request->post())) {
            $image->imageFile = UploadedFile::getInstance($image, 'imageFile');
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
