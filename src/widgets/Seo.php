<?php



namespace lawsaw\widgets;
use Yii;
use yii\base\Widget;



class OpenGraph extends Widget {

    public $title;
    public $description;
    public $image;
    public $url;
    public $type;

    public function init() {
        parent::init();
    }

    public function run() {
        $main = [
            'title' => $this->title,
            'description' => $this->description,
        ];
        $openGraph = array(
            [
                'title' => 'title',
                'tag' => 'og:title',
                'value' => $this->title
            ],[
                'title' => 'description',
                'tag' => 'og:description',
                'value' => $this->description
            ],[
                'title' => 'image',
                'tag' => 'og:image',
                'value' => $this->image
            ],[
                'title' => 'url',
                'tag' => 'og:url',
                'value' => $this->url
            ],[
                'title' => 'type',
                'tag' => 'og:type',
                'value' => $this->type
            ]
        );
        $options = [
            'main' => $main,
            'opengraph' => $openGraph
        ];
        return $this->render('seo',[
            'options' => $options
        ]);
    }
}

?>