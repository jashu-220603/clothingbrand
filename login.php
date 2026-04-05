<?php
session_start();
include "db.php";

// Check if form submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get form data
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    // Query user
    $sql = "SELECT id, fullname, email, password FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) == 1) {

        $row = mysqli_fetch_assoc($result);

        // Verify password
        if (password_verify($password, $row['password'])) {

            // Store session
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['fullname'];
            $_SESSION['user_email'] = $row['email'];

            // Redirect to index.php
            header("Location: index.php");
            exit();
        }
    }

    // Login failed → alert and show the form again
    echo "<script>alert('Invalid email or password');</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Mangalagiri Trends</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body style="background-color: #002366;"> 

<header class="top-header">
    <nav class="navbar">
        <a href="index.php" style="text-decoration: none;">
            <div class="logo-area">
                <div class="weaver_loom">
                    <img src="logo.png" alt="logo" width="100px" height="50px">
                </div>

                <div class="dynamic-text">
                    <span style="font-size: 1.8rem;">MANGALAGIRI</span> 
                    <small>TRENDS</small>
                </div>
            </div>
        </a>
    </nav>
</header>

<main style="max-width: 400px; margin: 50px auto; padding: 20px; text-align: center;">
    <h2 style="color: #D4AF37; margin-bottom: 20px;">Welcome Back</h2>
    
    <!-- Normal Login Form -->
    <form action="login.php" method="POST" style="background: rgba(255,255,255,0.05); padding: 30px; border-radius: 15px; border: 1px solid #D4AF37;">
        <input type="email" name="email" placeholder="Email Address" required style="width: 100%; padding: 12px; margin-bottom: 15px; border-radius: 8px; border: 1px solid #D4AF37; background: transparent; color: white;">

        <input type="password" name="password" placeholder="Password" required style="width: 100%; padding: 12px; margin-bottom: 15px; border-radius: 8px; border: 1px solid #D4AF37; background: transparent; color: white;">

        <button class="gold-btn" type="submit" style="width: 100%; border: none; padding: 12px; border-radius: 8px; font-weight: bold; cursor: pointer;">
            Login
        </button>

        <div style="margin: 20px 0; color: #fff;">OR</div>

        <!-- Google OAuth Login -->
        <a href="google-login.php" style="text-decoration: none;">
            <button type="button" class="gold-btn" style="width: 100%; border: 1px solid #D4AF37; background: transparent; color: #D4AF37; padding: 12px; border-radius: 8px; font-weight: bold; cursor: pointer; margin-bottom: 10px;">
                Login with Google
            </button>
        </a>

        <p style="color: #fff; margin-top: 20px;">
            Don't have an account? <a href="signup.php" style="color: #D4AF37; font-weight: 600;">Sign up</a>
        </p>
    </form>
</main>

<footer style="text-align: center; padding: 30px; color: rgba(255,255,255,0.6); font-size: 0.9rem;">
    <p>&copy; 2026 Mangalagiri Trends | Pure Handloom Products </p>
</footer>

</body>
</html>
