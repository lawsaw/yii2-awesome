<?php

$defer = $options->defer ? ['string'=>'defer','boolean'=>'true'] : ['string'=>'','boolean'=>'false'];

$pageScripts = [

    "jquery" => "
        
    ",

    "mCustomScrollbar" => "
        
    ",

    "recaptcha" => "
        
    ",

    "mainScript" => "
        
    ",

    "googleAnalytics" => "
        
    ",

    "googleConversion" => "    
        <!-- Google Conversion (Layout) -->
        <noscript>
            <div style='display:inline;'>
                <img height='1' width='1' style='border-style:none;' alt='' src='//www.googleadservices.com/pagead/conversion/814774925/?label=g7jgCMOMl38QjfXBhAM&amp;guid=ON&amp;script=0'/>
            </div>
        </noscript>
        <!-- End Google Conversion (Layout) -->
    ",

    "textbackNotification" => "
        <!-- Textback Notification (Layout) -->        
        <tb-notification-widget  widget-id='d3319a57-1bf2-bc49-4158-01624807b8b8'></tb-notification-widget>
        <!-- End Textback Notification (Layout) -->
    ",

    "textbackWidget" => "
        
    ",

    "facebookPixel" => "
        <!-- Facebook Pixel Code (Layout) -->
        <noscript>
            <img alt=' ' height='1' width='1' style='display:none' src='https://www.facebook.com/tr?id=1504583793004472&ev=PageView&noscript=1' />
        </noscript>        
        <!-- End Facebook Pixel Code (Layout) -->
    ",

    "facebookWidget" => "
        
    ",

];




foreach ($options->data as $key => $value) {

        if(isset($pageScripts[$key]) && $options->data[$key]) {

        if($key == 'mainScript') {
            $pageScripts[$key] = str_replace('[SCRIPT-FILE]', $options->data[$key], $pageScripts[$key]);
        }

        echo $pageScripts[$key];

    }
}

?>