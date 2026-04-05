<?php
session_start();
include "db.php";
require_once "mongodb_helper.php";

$mongo = new MongoDBHelper();
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $password_raw = $_POST['password'];
    $password_hash = password_hash($password_raw, PASSWORD_DEFAULT);

    // 🔍 Check if email already exists in MySQL
    $check = "SELECT id FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $check);

    if (mysqli_num_rows($result) > 0) {
        $message = "Email already exists. <a href='login.php' style='color: #D4AF37;'>Login here</a>";
    } else {
        // ✅ Insert into MySQL
        $sql = "INSERT INTO users (fullname, email, password) VALUES ('$fullname', '$email', '$password_hash')";

        if (mysqli_query($conn, $sql)) {
            // ✅ Insert into MongoDB
            if ($mongo->isConnected()) {
                $mongo->insert('users', [
                    'fullname' => $fullname,
                    'email' => $email,
                    'password' => $password_hash,
                    'created_at' => date('Y-m-d H:i:s')
                ]);
            }

            $_SESSION['user_name'] = $fullname;
            $_SESSION['user_email'] = $email;
            header("Location: index.php");
            exit();
        } else {
            $message = "Signup failed: " . mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | Mangalagiri Trends</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body style="background-color: #002366; display: flex; flex-direction: column; min-height: 100vh;">

    <header class="top-header" style="background: rgba(0, 26, 77, 0.9);">
        <nav class="navbar">
            <a href="index.php" style="text-decoration: none;">
                <div class="logo-area">
                    <div class="weaver-loom"><img src="logo.png" alt="logo" width="80px" height="40px"></div>
                    <div class="dynamic-text">
                        <span style="font-size: 1.5rem; font-weight: 900;">MANGALAGIRI</span> <br>
                        <small style="letter-spacing: 5px; font-size: 0.7rem;">TRENDS</small>
                    </div>
                </div>
            </a>
        </nav>
    </header>

    <main style="flex: 1; display: flex; align-items: center; justify-content: center; padding: 40px 5%;">
        <div style="max-width: 450px; width: 100%; animation: fadeInUp 0.8s ease;">
            <div style="text-align: center; margin-bottom: 30px;">
                <h2 style="color: #D4AF37; font-size: 2.5rem; margin-bottom: 10px;">Join Our Heritage</h2>
                <p style="color: rgba(255,255,255,0.7);">Experience the finest handloom masterpieces.</p>
            </div>

            <?php if ($message): ?>
                <div style="background: rgba(220, 53, 69, 0.2); border: 1px solid #dc3545; color: #ff6b7a; padding: 15px; border-radius: 12px; margin-bottom: 25px; text-align: center;">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>

            <form action="signup.php" method="POST" style="background: var(--glass-bg); padding: 40px; border-radius: 20px; border: 1px solid var(--glass-border); backdrop-filter: blur(10px);">
                <div style="margin-bottom: 20px;">
                    <label style="display: block; margin-bottom: 8px; font-size: 0.9rem; color: #D4AF37;">Full Name</label>
                    <input type="text" name="fullname" placeholder="Enter your full name" required style="width: 100%; padding: 15px; border-radius: 12px; border: 1px solid var(--glass-border); background: rgba(255,255,255,0.05); color: white; outline: none; transition: 0.3s;">
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="display: block; margin-bottom: 8px; font-size: 0.9rem; color: #D4AF37;">Email Address</label>
                    <input type="email" name="email" placeholder="email@example.com" required style="width: 100%; padding: 15px; border-radius: 12px; border: 1px solid var(--glass-border); background: rgba(255,255,255,0.05); color: white; outline: none; transition: 0.3s;">
                </div>

                <div style="margin-bottom: 30px;">
                    <label style="display: block; margin-bottom: 8px; font-size: 0.9rem; color: #D4AF37;">Create Password</label>
                    <input type="password" name="password" placeholder="At least 8 characters" required style="width: 100%; padding: 15px; border-radius: 12px; border: 1px solid var(--glass-border); background: rgba(255,255,255,0.05); color: white; outline: none; transition: 0.3s;">
                </div>

                <button type="submit" class="gold-btn" style="width: 100%; border: none; cursor: pointer; font-size: 1rem; letter-spacing: 1px;">
                    Create Account
                </button>

                <p style="color: rgba(255,255,255,0.5); text-align: center; margin-top: 25px; font-size: 0.95rem;">
                    Already have an account? <a href="login.php" style="color: #D4AF37; text-decoration: none; font-weight: 600;">Login</a>
                </p>
            </form>
        </div>
    </main>

    <footer style="text-align: center; padding: 40px; color: rgba(255,255,255,0.4); font-size: 0.85rem; border-top: 1px solid var(--glass-border);">
        <p>&copy; 2026 Mangalagiri Trends | Handcrafted with Tradition</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>
