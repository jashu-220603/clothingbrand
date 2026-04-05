<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $inputUser = trim($_POST['username']);
    $inputPass = $_POST['password'];

    /* Dummy stored credentials */
    $storedUser = "admin";
    $storedPass = "admin123";

    /* Case-sensitive comparison */
    if (strcmp($inputUser, $storedUser) !== 0) {
        die("Invalid Username");
    }

    /* Case-insensitive example */
    if (strcasecmp($inputPass, $storedPass) !== 0) {
        die("Invalid Password");
    }

    echo "Login Successful<br>";
    print "Welcome, $inputUser";
}
?>
