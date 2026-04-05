<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST['username']);
    $name = trim($_POST['name']);
    $password = $_POST['password'];

    /* Clean input */
    $username = strtolower($username);
    $name = ucwords($name);

    /* Validation */
    if (strlen($username) < 5) {
        die("Username must be at least 5 characters");
    }

    if (strlen($password) < 6) {
        die("Password must be at least 6 characters");
    }

    $username = addslashes($username);
    $name = addslashes($name);

    echo "Registration Successful<br>";
    echo "Username: $username <br>";
    print "Name: $name";
}
?>
