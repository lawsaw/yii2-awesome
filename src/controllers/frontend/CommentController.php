<?php
/**
 * Created by PhpStorm.
 * User: georgy
 * Date: 13.12.14
 * Time: 23:37
 */

namespace lawsaw\controllers\frontend;

use lawsaw\models\common\Comment;
use lawsaw\models\frontend\CommentForm;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\User;

/**
 * Контроллер "Комментарий".
 */
class CommentController extends Controller
{
    public function actionAdd()
    {
        $model = new Comment();

        $commentForm = new CommentForm(Url::to(['comment/add', 'id' => Yii::$app->request->get('id')]));
        $model->post_id = Yii::$app->request->get('id');

        if (Yii::$app->user instanceof User) {
            $model->author_id = Yii::$app->user->getIdentity()->getId();
        }

        if ($commentForm->save($model, Yii::$app->request->post('CommentForm'))) {
            return $this->redirect(['post/view', 'id' => Yii::$app->request->get('id')]);
        } else {
            return $this->render('@lawsaw/views/frontend/comment/create.php', [
                'model' => $commentForm
            ]);
        }
    }
}