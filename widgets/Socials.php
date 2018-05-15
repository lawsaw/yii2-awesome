<?php



namespace lawsaw\widgets;
use Yii;
use yii\base\Widget;



class Socials extends Widget {

    public $className;
    public $tooltipPos;

    public function init() {
        parent::init();
    }

    public function run() {
        $options = [
            'className' => $this->className,
            'tooltipPos' => $this->tooltipPos
        ];
        return $this->render('socials', $options);
    }
}

?>