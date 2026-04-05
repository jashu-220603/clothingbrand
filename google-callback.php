<?php
session_start();
require 'env.php';
require 'google-api-client/vendor/autoload.php';
include "db.php";

$client = new Google_Client();
$client->setClientId(getenv('GOOGLE_CLIENT_ID'));
$client->setClientSecret(getenv('GOOGLE_CLIENT_SECRET'));
$client->setRedirectUri(getenv('REDIRECT_URI') ?: "http://localhost/website/google-callback.php");



if (isset($_GET['code'])) {

    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

    if (!isset($token['error'])) {

        $client->setAccessToken($token);

        $google = new Google_Service_Oauth2($client);

        $user = $google->userinfo->get();

        $email = mysqli_real_escape_string($conn, $user->email);
        $name  = mysqli_real_escape_string($conn, $user->name);

        // Check if user exists
        $sql = "SELECT id, fullname, email FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 0) {

            // Create new user (Google login)
            $random_password = password_hash(uniqid(), PASSWORD_DEFAULT);

            mysqli_query($conn,
            "INSERT INTO users(fullname,email,password)
             VALUES('$name','$email','$random_password')");

            $user_id = mysqli_insert_id($conn);

        } else {

            $row = mysqli_fetch_assoc($result);
            $user_id = $row['id'];
            $name    = $row['fullname'];
        }

        // Set SAME session variables as login.php
        $_SESSION['user_id']    = $user_id;
        $_SESSION['user_name']  = $name;
        $_SESSION['user_email'] = $email;

        header("Location: index.php");
        exit();
    }
}
?>
