<?php

namespace lawsaw\controllers\backend;

use lawsaw\models\common\Category;
use lawsaw\models\common\Tags;
use lawsaw\models\common\User;
use Yii;
use lawsaw\models\common\Post;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * CRUD операции модели "Посты".
 */
class PostController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'create', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
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
        $dataProvider = new ActiveDataProvider([
            'query' => Post::find(),
        ]);

        return $this->render('@lawsaw/views/backend/post/index.php', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Просмотр поста.
     * @param string $id идентификатор поста
     * @return string
     */
    public function actionView($id)
    {
        return $this->render('@lawsaw/views/backend/post/view.php', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Создание поста.
     * @return string|Response
     */
    public function actionCreate()
    {
        $model = new Post();

//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        } else {
//            $model->author_id = Yii::$app->user->id;
//            return $this->render('create', [
//                'model' => $model,
//                'category' => Category::find()->all(),
//                'tags' => Tags::find()->all(),
//                'authors' => User::find()->all()
//            ]);
//        }


        if ($model->load(Yii::$app->request->post())) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                $model->author_id = Yii::$app->user->id;
                return $this->render('@lawsaw/views/backend/post/create.php', [
                    'model' => $model,
                    'category' => Category::find()->all(),
                    'tags' => Tags::find()->all(),
                    'authors' => User::find()->all()
                ]);
            }
        } else {
            return $this->render('@lawsaw/views/backend/post/create.php', [
                'model' => $model,
                'category' => Category::find()->all(),
                'tags' => Tags::find()->all(),
                'authors' => User::find()->all()
            ]);
        }


    }

    /**
     * Редактирование поста.
     * @param string $id идентификатор редактируемого поста
     * @return string|Response
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        } else {
//            return $this->render('update', [
//                'model' => $model,
//                'authors' => User::find()->all(),
//                'tags' => Tags::find()->all(),
//                'category' => Category::find()->all()
//            ]);
//        }


        if ($model->load(Yii::$app->request->post())){
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }else {
                return $this->render('@lawsaw/views/backend/post/update.php', [
                    'model' => $model,
                    'authors' => User::find()->all(),
                    'tags' => Tags::find()->all(),
                    'category' => Category::find()->all()
                ]);
            }
        } else {
            return $this->render('@lawsaw/views/backend/post/update.php', [
                'model' => $model,
                'authors' => User::find()->all(),
                'tags' => Tags::find()->all(),
                'category' => Category::find()->all()
            ]);
        }
    }

    /**
     * Удаление поста.
     * @param string $id идентификатор удаляемого поста
     * @return Response
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        //if (($model = Post::findOne($id)) !== null) {
        if (($model = Post::find()->multilingual()->where(['id' => $id])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
