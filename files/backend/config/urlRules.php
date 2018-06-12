<?php
return [


    '<_c>' => 'lawsaw/backend/<_c>',
    '<_c>/<_a>' => 'lawsaw/backend/<_c>/<_a>',



    '<_c:[\w\-]+>/<id:\d+>' => '<_c>/view',
    '<_c:[\w\-]+>' => '<_c>/index',
    '<_c:[\w\-]+>/<_a:[\w\-]+>/<id:\d+>' => '<_c>/<_a>',

];