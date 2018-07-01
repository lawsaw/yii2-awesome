<?php
return [

    '/' => 'site/index',

    'news' => 'post/index',
    'news/<id:\d+>' => 'post/view',
    'news/category/<id:\d+>' => 'category/view',
    'news/tag/<id:\d+>' => 'tag/view',

    'modal' => 'lawsaw/frontend/modal/index',

//    '/' => 'site/index',
//    [
//        'pattern' => 'news',
//        'route' => 'news/default/index',
//        'suffix' => '.html',
//    ],
//    [
//        'pattern' => '<action>',
//        'route' => 'site/<action>',
//        'suffix' => '.html',
//    ],
//    [
//        'pattern' => '<module>/<id:\d+>',
//        'route' => '<module>/default/view',
//        'suffix' => '.html',
//    ],

//    '/' => 'site/index',
//    'modal' => 'lawsaw/modal',

//    '' => 'site/index',
//    '<controller:\w+>/<action:\w+>/' => '<controller>/<action>',

//    [
//        'pattern' => 'about',
//        'route' => 'site/about',
//        'suffix' => '/',
//    ],
//    [
//        'pattern' => 'modal',
//        'route' => 'modal/index',
//        'suffix' => '.html',
//    ],

//'<_c:[\w\-]+>/<id:\d+>' => '<_c>/view',
//'<_c:[\w\-]+>' => '<_c>/index',
//'<_c:[\w\-]+>/<_a:[\w\-]+>/<id:\d+>' => '<_c>/<_a>',

//'<controller:\w+>/<action:\w+>/' => '<controller>/<action>',
];