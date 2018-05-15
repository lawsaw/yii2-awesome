<?php



namespace lawsaw\widgets;
use Yii;
use yii\base\Widget;



class Svg extends Widget {

    public $icon;
    public $className;


    public function init() {
        parent::init();
    }

    public function run() {
        $options = [
            'icon' => $this->icon,
            'className' => $this->className
        ];
        return $this->render('svg', $options);
    }
}

?>