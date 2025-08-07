<?php
require_once __DIR__ . '/../vendor/autoload.php';
use Twilio\Rest\Client;

function send_sms($to, $message) {
    
    if (substr($to, 0, 1) === '0') {
        $to = '+63' . substr($to, 1);
    }

    $sid = 'AC78a73be4f63fb90ba81df99a8916174c'; // Your Account SID
    $token = '7485f46cf3c0633c233a76bc56696723'; // Your Auth Token
    $twilio_number = '+639557945049'; 
    $client = new Client($sid, $token);

    try {
        $client->messages->create(
            $to,
            [
                'from' => $twilio_number,
                'body' => $message
            ]
        );
        return true;
    } catch (Exception $e) {
       
        error_log("Twilio SMS Error: " . $e->getMessage());
        return false;
    }
}
