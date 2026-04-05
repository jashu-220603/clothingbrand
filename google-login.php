<?php 
require 'env.php';
require 'google-api-client/vendor/autoload.php';

$client = new Google_Client();
$client->setClientId(getenv('GOOGLE_CLIENT_ID'));
$client->setClientSecret(getenv('GOOGLE_CLIENT_SECRET'));
$client->setRedirectUri(getenv('REDIRECT_URI') ?: "http://localhost/website/google-callback.php");



$client->addScope("email");
$client->addScope("profile");

header("Location: " . $client->createAuthUrl());
exit();

?>
