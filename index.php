<?php
session_start();
include_once 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mangalagiri Trends | Handcrafted Heritage</title>
    <!-- SEO Meta Tags -->
    <meta name="description" content="Discover authentic Mangalagiri handloom sarees, Nizam border fabrics, and traditional Indian ethnic wear at Mangalagiri Trends.">
    <meta name="keywords" content="Mangalagiri sarees, handloom, Nizam border, Indian ethnic wear, traditional sarees">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="logo.png">
</head>
<body>
    <header class="top-header" id="navbar">
        <nav class="navbar">
            <div class="logo-area">
                <div class="weaver-loom"><img src="logo.png" alt="Mangalagiri Trends Logo" width="80px" height="40px"></div>
                <div class="dynamic-text">
                    <span style="font-size: 1.5rem; font-weight: 900;">MANGALAGIRI</span> <br>
                    <small style="letter-spacing: 5px; font-size: 0.7rem;">TRENDS</small>
                </div>
            </div>
            <ul class="nav-links">
                <li><a href="#home">Home</a></li>
                <li><a href="#collections">Collections</a></li>
                <li><a href="#about">Our Story</a></li>
                <li><a href="#contact">Contact</a></li>
                <?php if (isset($_SESSION['user_name'])): ?>
                    <li style="margin-left: 20px;">
                        <span style="color: rgba(255,255,255,0.7); font-size: 0.8rem;">Welcome,</span>
                        <a href="logout.php" style="color: var(--primary-color); text-transform: none; margin-left: 5px;">Logout</a>
                    </li>
                <?php else: ?>
                    <li><a href="login.php" class="login">Login / Sign In</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <section class="hero" id="home">
        <div class="hero-content">
            <h1>The Art of Mangalagiri</h1>
            <p>Experience the 500-year-old heritage of hand-woven excellence. Every thread is a masterpiece of precision and passion.</p>
            <div style="margin-top: 40px;">
                <a href="#collections" class="gold-btn">Explore Collection</a>
            </div>
        </div>
    </section>

    <section class="collections" id="collections">
        <h2 class="section-title">Our Signature Collections</h2>
        <div class="product-grid">
            <!-- Product 1 -->
            <div class="product-card" onclick="window.location.href='saree1.php'">
                <div class="product-img" style="background-image: url('saree1.jpg');"></div>
                <div class="product-info">
                    <span style="color: rgba(255,255,255,0.5); font-size: 0.8rem; text-transform: uppercase;">Classic Handloom</span>
                    <h3>The Nizam Border Saree</h3>
                    <p class="price">₹2,450</p>
                    <a href="saree1.php" class="view-link">View Details</a>
                </div>
            </div>
            <!-- Product 2 -->
            <div class="product-card" onclick="window.location.href='saree2.php'">
                <div class="product-img" style="background-image: url('saree2.jpg');"></div>
                <div class="product-info">
                    <span style="color: rgba(255,255,255,0.5); font-size: 0.8rem; text-transform: uppercase;">Premium Silk</span>
                    <h3>Pattu Silk Special Edition</h3>
                    <p class="price">₹5,800</p>
                    <a href="saree2.php" class="view-link">View Details</a>
                </div>
            </div>
            <!-- Product 3 -->
            <div class="product-card" onclick="window.location.href='shirt1.php'">
                <div class="product-img" style="background-image: url('shirt1.webp');"></div>
                <div class="product-info">
                    <span style="color: rgba(255,255,255,0.5); font-size: 0.8rem; text-transform: uppercase;">Men's Heritage</span>
                    <h3>Handloom Checks Casual Shirt</h3>
                    <p class="price">₹1,299</p>
                    <a href="shirt1.php" class="view-link">View Details</a>
                </div>
            </div>
            <!-- Product 4 -->
            <div class="product-card" onclick="window.location.href='teja.php'">
                <div class="product-img" style="background-image: url('teja.jpeg');"></div>
                <div class="product-info">
                    <span style="color: rgba(255,255,255,0.5); font-size: 0.8rem; text-transform: uppercase;">Designer Exclusive</span>
                    <h3>Teja Exclusive Handloom Wear</h3>
                    <p class="price">₹3,499</p>
                    <a href="teja.php" class="view-link">View Details</a>
                </div>
            </div>
            <!-- Product 5 -->
            <div class="product-card" onclick="window.location.href='saree3.php'">
                <div class="product-img" style="background-image: url('saree3.jpeg');"></div>
                <div class="product-info">
                    <span style="color: rgba(255,255,255,0.5); font-size: 0.8rem; text-transform: uppercase;">Daily Wear</span>
                    <h3>Lightweight Cotton Saree</h3>
                    <p class="price">₹1,850</p>
                    <a href="saree3.php" class="view-link">View Details</a>
                </div>
            </div>
            <!-- Product 6 -->
            <div class="product-card" onclick="window.location.href='shirt1.php'">
                <div class="product-img" style="background-image: url('shirt1.webp');"></div>
                <div class="product-info">
                    <span style="color: rgba(255,255,255,0.5); font-size: 0.8rem; text-transform: uppercase;">Men's Heritage</span>
                    <h3>Striped Handloom Formal Shirt</h3>
                    <p class="price">₹1,499</p>
                    <a href="shirt1.php" class="view-link">View Details</a>
                </div>
            </div>
        </div>
    </section>

    <section class="about-section" id="about">
        <div class="about-box">
            <h2 class="section-title">Our Story</h2>
            <p>Mangalagiri Trends is dedicated to preserving the ancient looms of Andhra Pradesh. By bridging the gap between traditional craftsmanship and modern fashion, we bring you timeless pieces that are as unique as the hands that wove them.</p>
        </div>
    </section>

    <section class="contact-section" id="contact">
        <h2 class="section-title">Visit Our Loom</h2>
        <div class="contact-flex">
            <div class="contact-details">
                <h3>Store Timings</h3>
                <table class="product-table">
                    <tr>
                        <th>Monday – Saturday</th>
                        <td>09:30 AM – 08:30 PM</td>
                    </tr>
                    <tr>
                        <th>Sunday</th>
                        <td>10:00 AM – 06:00 PM</td>
                    </tr>
                </table>
                
                <h3>Store Location</h3>
                <p>📍 Temple Road, Mangalagiri, Andhra Pradesh, India - 522503</p>
                <div style="margin-top: 30px;">
                    <p>📞 +91 99887 76655</p>
                    <p>✉️ hello@mangalagiritrends.com</p>
                </div>
            </div>
            
            <div class="contact-form-container" style="flex: 1;">
                <h3 style="margin-bottom: 20px; font-family: 'Poppins', sans-serif;">Send us a message</h3>
                <form class="contact-form">
                    <input type="text" placeholder="Your Name" required>
                    <input type="email" placeholder="Your Email" required>
                    <textarea placeholder="Tell us how we can help..." rows="5" required></textarea>
                    <button type="submit" class="gold-btn" style="width:100%; border:none; cursor: pointer;">Send Message</button>
                </form>
            </div>
        </div>
    </section>

    <footer>
        <div style="margin-bottom: 20px;">
            <img src="logo.png" alt="Logo" width="60px">
        </div>
        <p>&copy; <span id="year"></span> Mangalagiri Trends | Crafted with Love by Local Weavers</p>
        <div style="margin-top: 15px; font-size: 0.8rem; color: rgba(255,255,255,0.4);">
            <a href="#" style="color: inherit; margin: 0 10px; text-decoration: none;">Privacy Policy</a> | 
            <a href="#" style="color: inherit; margin: 0 10px; text-decoration: none;">Terms of Service</a>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>
