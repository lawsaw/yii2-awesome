<?php

$this->title = $options['main']['title'];

$this->registerMetaTag([
    'name' => 'description',
    'content' => $options['main']['description'],
]);

foreach ($options['opengraph'] as $key => $value) {

    $this->registerMetaTag([
        'name' => $value['tag'],
        'content' => $value['value'],
    ]);

    $this->registerMetaTag([
        'property' => $value['tag'],
        'content' => $value['value'],
    ]);

}

?>