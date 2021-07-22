<?php

namespace app\modules\posts\controllers;

use app\modules\posts\models\Post;
use yii\helpers\Url;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

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
        if ($post->load(Yii::$app->request->post())) {
            $post->setUserId(Yii::$app->user->id);
            if ($post->save()) {
                return $this->redirect(Url::to(['/posts/post/post', 'id' => $post->id]));
            }
        }

        return $this->render('post-edit', [
            'post' => $post,
        ]);
    }

}
