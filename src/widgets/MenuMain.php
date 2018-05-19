<?php



namespace lawsaw\widgets;
use Yii;
use yii\base\Widget;



class MenuMain extends Widget {

    public $className;

    public function init() {
        parent::init();
    }

    public function run() {
        $options = [
            'className' => $this->className
        ];
        return $this->render('menumain', $options);
    }
}

?>