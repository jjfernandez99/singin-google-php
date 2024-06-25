<?php

require_once 'vendor/autoload.php';

session_start();

// init configuration
$clientID = '234204260472-4dd49l8btvgirmrb47puf253bme7b6sd.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUri = 'http://pagina.entelvas.com/go/php-google-login/welcome.php';

// create Client Request to access Google API
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");

// Connect to database
$hostname = "10.118.224.3";
$username = "entel";
$password = "Entel12345";
$database = "sing-in";

//$conn = mysqli_connect($hostname, $username, $password, $database);
