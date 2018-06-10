<?php



namespace lawsaw\widgets;
use Yii;
use yii\base\Widget;



class HeadTitle extends Widget {

    public $title;
    public $description;

    public function init() {
        parent::init();
    }

    public function run() {
        return $this->render('headtitle',[
            'title'=>$this->title,
            'description'=>$this->description,
        ]);
    }
}

?>