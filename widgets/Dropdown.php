<?php



namespace lawsaw\widgets;
use Yii;
use yii\base\Widget;


class Dropdown extends Widget {

    public $type;
    public $className;
    public $frontTheme;
    public $backTheme;
    public $size;
    public $current;
    public $iconBefore;
    public $iconAfter;
    public $biasLeft;
    public $biasRight;
    public $content;


    public function init() {
        parent::init();
    }

    public function run() {
        $options = [
           'container' => [
               'className' => $this->className,
           ],
           'front' => [
               'theme' => $this->frontTheme,
               'size' => $this->size,
               'current' => $this->current,
               'iconBefore' => $this->iconBefore,
               'iconAfter' => $this->iconAfter
           ],
           'back' => [
               'theme' => $this->backTheme,
               'biasLeft' => $this->biasLeft,
               'biasRight' => $this->biasRight,
               'content' => $this->content,
           ]
        ];
        return $this->render('dropdown', $options);
    }
}

?>