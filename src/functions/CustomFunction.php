<?php



function test()
{
    return 'Hello World';
}



function getOptions($options)
{
    $newOptions = [];
    foreach ($options as $key => $value) {
        $newOptions[$key] = $options[$key] ? $options[$key] : '';
    }
    return $newOptions;
}



function sendEmail($params)
{
    return Yii::$app->mailer->compose(
        [
            'html' => $params['theme']
        ],
        $params['data']
    )
        ->setTo($params['to'])
        ->setFrom($params['from'])
        ->setSubject($params['subject'])
        ->send();
}



function getLang()
{
    $lang = '';
    switch(Yii::$app->language) {
        case 'en-EN':
            $lang = 'en';
            break;
        case 'ru-RU':
            $lang = 'ru';
            break;
        default:
            $lang = 'default';
            break;
    }
    return $lang;
}



function validCaptcha($model, $attribute, $message)
{
    if(!empty($model->$attribute))
    {
        $curl = curl_init('https://www.google.com/recaptcha/api/siteverify');

        curl_setopt_array($curl , [
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => [
                'secret' => Yii::$app->params['recaptchaSitekeySecret'],
                'response' => $model->$attribute,
            ],
            CURLOPT_RETURNTRANSFER => true
        ]);

        $resp = json_decode(curl_exec($curl));

        curl_close($curl);

        if($resp->success == true)
        {
            return true;
        }
        else {
            return $model->addError($attribute , $message['confirm_again'] );
        }
    }
    else
    {
        return $model->addError($attribute , $message['confirm'] );
    }
}



function setScript()
{

    return [
        'js' => function ($file, $language = null) {
            $styleVersion = Yii::$app->params['styleVersion'];
            $language = isset($language) ? $language : getLang();
            $script = <<< JS
            
            
                var defer = {
                    'styleVersion': '$styleVersion',
                    'language': '$language',
                    'js': '$file'
                }
                
                
JS;
            return $script;
        },
        'iframe' => function () {
            $script = <<< JS
            
            
                function init() {
                    var vidDefer = document.getElementsByTagName('iframe');                    
                    for (var i = 0; i < vidDefer.length; i++) {
                        if (vidDefer[i].getAttribute('data-src')) {
                            vidDefer[i].setAttribute('src', vidDefer[i].getAttribute('data-src'));
                        }
                    }
                }
                window.onload = init;


JS;
            return $script;
        },
        'defer' => function () {
            $styleVersion = Yii::$app->params['styleVersion'];
            $script = <<< JS
            
            
                function downloadJSAtOnload() {
                    var element = document.createElement("script");
                    element.src = "/js/defer.js?v=$styleVersion";
                    document.body.appendChild(element);
                }
                if (window.addEventListener)
                    window.addEventListener("load", downloadJSAtOnload, false);
                else if (window.attachEvent)
                    window.attachEvent("onload", downloadJSAtOnload);
                else window.onload = downloadJSAtOnload;
                
                
JS;
            return $script;
        }
    ];

}
