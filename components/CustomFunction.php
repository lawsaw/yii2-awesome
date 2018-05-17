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
            return $model->addError($attribute , $message->confirm_again );
        }
    }
    else
    {
        return $model->addError($attribute , $message->confirm );
    }
}