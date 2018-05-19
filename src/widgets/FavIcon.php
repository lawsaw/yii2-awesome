<?php



namespace lawsaw\widgets;
use Yii;
use yii\base\Widget;



class FavIcon extends Widget {

    public $icon;

    public function init() {
        parent::init();
    }

    public function run() {
        return $this->render('favicon',[
            'icon'=>$this->icon,
        ]);
    }
}

?>