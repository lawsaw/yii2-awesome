<?php

namespace lawsaw\controllers\frontend;

use lawsaw\models\common\Category;
use lawsaw\models\frontend\CommentForm;
use Yii;
use lawsaw\models\common\Post;
use yii\helpers\Url;
use yii\web\Controller;
use yii\filters\VerbFilter;
use frontend\controllers\AppController;

/**
 * Контролеры "Постов".
 */
class PostController extends AppController
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Список постов.
     * @return string
     */
    public function actionIndex()
    {
        $post = new Post();
        $category = new Category();

        $posts = $post->getPublishedPosts();
        $posts->setPagination([
            'pageSize' => Yii::$app->params['pageSize']
        ]);

        return $this->render('@lawsaw/views/frontend/post/index.php', [
            'posts' => $posts,
            'categories' => $category->getCategories()
        ]);
    }

    /**
     * Просмотр поста.
     * @param string $id идентификатор поста
     * @return string
     */
    public function actionView($id)
    {
        $post = new Post();
        return $this->render('@lawsaw/views/frontend/post/view.php', [
            'model' => $post->getPost($id),
            'commentForm' => new CommentForm(Url::to(['comment/add', 'id' => $id])),
        ]);
    }
}
