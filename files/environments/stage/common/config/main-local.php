<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=saw04.mysql.tools;dbname=saw04_yii2adv',
            'username' => 'saw04_yii2adv',
            'password' => 'b5awjdez',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
        ],
    ],
];
