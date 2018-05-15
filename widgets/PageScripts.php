<?php



namespace lawsaw\widgets;
use Yii;
use yii\base\Widget;



class PageScripts extends Widget {

    public $data;
    public $defer;

    public function init() {
        parent::init();
    }

    public function run() {

        return $this->render('pagescripts-layout-only',[
            'options'=>$this
        ]);
    }
}

?>