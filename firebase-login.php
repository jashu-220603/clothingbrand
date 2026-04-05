<?php

session_start();
include "db.php";

$data = json_decode(file_get_contents("php://input"), true);

$name = mysqli_real_escape_string($conn, $data['name']);
$email = mysqli_real_escape_string($conn, $data['email']);

$sql = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) == 0){

    $password = password_hash(uniqid(), PASSWORD_DEFAULT);

    mysqli_query($conn,
    "INSERT INTO users(fullname,email,password)
     VALUES('$name','$email','$password')");

    $user_id = mysqli_insert_id($conn);

}else{

    $row = mysqli_fetch_assoc($result);
    $user_id = $row['id'];
}

$_SESSION['user_id'] = $user_id;
$_SESSION['user_name'] = $name;
$_SESSION['user_email'] = $email;

echo "success";

?>
