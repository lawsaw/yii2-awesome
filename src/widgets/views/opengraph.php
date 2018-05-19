<?php

foreach ($options as $key => $value) {

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