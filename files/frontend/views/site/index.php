<?php

use lawsaw\widgets\Seo;
use lawsaw\widgets\Button;

?>


<?php



    \frontend\controllers\debug(15);

?>

<?= Seo::widget([
    'title'         => 'Заголовок',
    'description'   => 'Описание',
    'image'         => 'Картинка',
    'url'           => 'сайт',
    'type'          => 'тип'
]); ?>

Index page


<?= Button::widget([
    'classContent' => 'awModalOpen',
    'theme' => 'lightblue',
    'size' => 'sizeL',
    'href' => '#',
    'label' => 'Open modal',
    'modal' => [
        'id' => 'testModal',
        'mode' => 'sidebarTop',
        'anim' => [
            'in' => 'sidebarToBottom',
            'out' => 'sidebarToTop',
        ],
        'workClass' => 'css-vertical-align-top'
    ]
]); ?>

<?= Button::widget([
    'classContent' => 'awModalOpen',
    'theme' => 'lightblue',
    'size' => 'sizeL',
    'href' => '#',
    'label' => Yii::t('f', 'form modal'),
    'modal' => [
        'id' => 'formModal',
        'mode' => '',
        'anim' => [
            'in' => 'zoomIn',
            'out' => 'zoomIn',
        ],
        'workClass' => '',
        'model' => 'TestForm',
    ]
]); ?>


