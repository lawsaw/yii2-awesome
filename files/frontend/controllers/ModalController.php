<?php
//namespace frontend\controllers\user;
namespace frontend\controllers;

use lawsaw\controllers\frontend\ModalController as BaseModalController;

use Yii;
use yii\web\Controller;

class ModalController extends BaseModalController
{
    public function actionIndex($modal = null, $mode = null , $animIn = null, $animOut = null, $workClass = null, $ajax = null, $message = null, $model = null, $contentData = [])
    {
        var_dump(1230);
        return 151;
    }
}