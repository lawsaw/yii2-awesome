<?php
/**
 * Created by PhpStorm.
 * User: sqrl
 * Date: 6/24/16
 * Time: 11:53 AM
 */

namespace lawsaw\controllers\frontend;

use Yii;
use yii\web\Controller;
use frontend\controllers\AppController;

class ModalController extends AppController
{
    public function actionIndex($modal, $mode , $animIn, $animOut, $workClass, $ajax, $message, $model, $contentData = [])
    {

        $model = $model == 'false' ? false : $model;

        if($model) {

            $modelClass = "\\common\\models\\$model";

            $model = new $modelClass;

            $contentData = [
                'model' => $model,
            ];

        }

        $data = [
            'contentView' => "../modals/$modal",
            'contentData' => $contentData,
            'modal' => $modal,
            'mode' => $mode,
            'animIn' => $animIn,
            'animOut' => $animOut,
            'workClass' => $workClass,
            'ajax' => $ajax,
            'message' => $message
        ];



        if($message == 'false') {

            if (file_exists(\Yii::getAlias('@frontend') . "/views/modals/$modal.php")) {
                return $this->renderFile('@lawsaw/views/frontend/layouts/layout-modal.php', $data);
            } else {
                echo json_encode([
                    'status' => 'error'
                ]);
            }

//            if (file_exists(\Yii::getAlias('@frontend') . "/views/modals/$modal.php")) {
//                return $this->renderPartial('//layouts/layout-modal', $data);
//            } else {
//                echo json_encode([
//                    'status' => 'error'
//                ]);
//            }

        } else {

            return $this->renderFile('@lawsaw/views/frontend/layouts/layout-modal.php', $data);

        }




    }

}