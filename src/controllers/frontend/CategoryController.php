<?php
/**
 * Created by PhpStorm.
 * User: georgy
 * Date: 18.10.14
 * Time: 2:03
 */

namespace lawsaw\controllers\frontend;

use lawsaw\models\common\Category;
use Yii;
use yii\web\Controller;

/**
 * Контроллеры "Категорий".
 */
class CategoryController extends AppController
{
    public function actionView($id)
    {
        $categoryModel = new Category();
        $category = $categoryModel->getCategory($id);

        $posts = $category->getPosts();
        $posts->setPagination([
            'pageSize' => Yii::$app->params['pageSize']
        ]);

        return $this->render('@lawsaw/views/frontend/category/index.php', [
            'category' => $category,
            'posts' => $posts,
            'categories' => $categoryModel->getCategories()
        ]);
    }
} 