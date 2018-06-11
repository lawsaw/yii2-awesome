<?php
/**
 * Created by PhpStorm.
 * User: georg
 * Date: 24.06.15
 * Time: 17:30
 */

namespace lawsaw\controllers\frontend;

use lawsaw\models\common\Category;
use lawsaw\models\common\Tags;
use Yii;
use yii\web\Controller;

/**
 * Контроллер "Тэги".
 */
class TagController extends AppController
{
    /**
     * Просмотр списка постов по тегу
     * @param $id
     * @return string
     */
    public function actionView($id)
    {
        $tagModel = new Tags();
        $tag = $tagModel->getTag($id);
        $categoryModel = new Category();
        
        $posts = $tag->getPublishedPosts();
        $posts->setPagination([
            'pageSize' => Yii::$app->params['pageSize']
        ]);

        return $this->render('@lawsaw/views/frontend/post/view.php', [
            'tag' => $tag,
            'posts' => $posts,
            'categories' => $categoryModel->getCategories()
        ]);
    }
}
