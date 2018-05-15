<?php



namespace lawsaw\widgets;
use Yii;
use yii\base\Widget;



class Button extends Widget {

    public $theme;
    public $size;
    public $iconBeforeClass;
    public $iconBefore;
    public $iconAfterClass;
    public $iconAfter;
    public $href;
    public $label;
    public $className;
    public $classContent;
    public $classTitle;
    public $classText;
    public $modal;
    public $model;
    public $onclick;


    public function init() {
        parent::init();
    }

    public function run() {
        $options = [
            'theme' => $this->theme,
            'size' => $this->size,
            'iconBeforeClass' => $this->iconBeforeClass,
            'iconBefore' => $this->iconBefore,
            'iconAfterClass' => $this->iconAfterClass,
            'iconAfter' => $this->iconAfter,
            'href' => $this->href,
            'label' => $this->label,
            'className' => $this->className,
            'classContent' => $this->classContent,
            'classTitle' => $this->classTitle,
            'classText' => $this->classText,
            'modal' => $this->modal,
            'model' => $this->model,
            'onclick' => $this->onclick,
        ];
        return $this->render('button', $options);
    }
}

?>
