<?php
require 'vendor/autoload.php';

$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$twilio = new \Twilio\Rest\Client($_ENV['TWILIO_SID'], $_ENV['TWILIO_TOKEN']);

$msg = $twilio->messages->create('whatsapp:+573214546948', [
    'from' => 'whatsapp:+14155238886',
    'body' => 'Prueba Clinica Colombia'
]);
echo $msg->sid;