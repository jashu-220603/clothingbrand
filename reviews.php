<?php
include_once 'db.php';
require_once 'mongodb_helper.php'; // Include the MongoDB Helper

$mongo = new MongoDBHelper();
$is_mongo_active = $mongo->isConnected();

// Ensure reviews table exists in MySQL (Legacy)
$sql_table = "CREATE TABLE IF NOT EXISTS reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id VARCHAR(50) NOT NULL,
    reviewer_name VARCHAR(100) NOT NULL,
    rating INT CHECK (rating >= 1 AND rating <= 5),
    comment TEXT NOT NULL,
    file_path VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
mysqli_query($conn, $sql_table);

// Handle form submission
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_review'])) {
    $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);
    $reviewer_name = mysqli_real_escape_string($conn, $_POST['reviewer_name']);
    $rating = (int)$_POST['rating'];
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);
    $file_path = "";

    // Handle File Upload
    if (isset($_FILES['review_file']) && $_FILES['review_file']['error'] == 0) {
        $upload_dir = 'uploads/';
        if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);
        
        $file_name = time() . '_' . basename($_FILES['review_file']['name']);
        $target_file = $upload_dir . $file_name;
        $file_ext = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if (in_array($file_ext, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
            if (move_uploaded_file($_FILES['review_file']['tmp_name'], $target_file)) {
                $file_path = $target_file;
            }
        }
    }

    if (empty($message)) {
        // 1. SAVE TO MYSQL (Primary/Backup)
        $sql = "INSERT INTO reviews (product_id, reviewer_name, rating, comment, file_path) 
                VALUES ('$product_id', '$reviewer_name', '$rating', '$comment', '$file_path')";
        
        if (mysqli_query($conn, $sql)) {
            $message = "Review submitted successfully!";
            
            // 2. SAVE TO MONGODB (New Feature)
            if ($is_mongo_active) {
                $mongo->insertReview([
                    'product_id' => $product_id,
                    'reviewer_name' => $reviewer_name,
                    'rating' => $rating,
                    'comment' => $comment,
                    'file_path' => $file_path,
                    'created_at' => date('Y-m-d H:i:s')
                ]);
            }
        } else {
            $message = "Database error: " . mysqli_error($conn);
        }
    }
}

// Fetch reviews for this product from MySQL
$reviews_query = "SELECT * FROM reviews WHERE product_id = '$product_id' ORDER BY created_at DESC";
$reviews_result = mysqli_query($conn, $reviews_query);
?>

<!-- Review Section UI -->
<style>
    .review-section {
        background: rgba(255, 255, 255, 0.03);
        padding: 40px;
        border-radius: 20px;
        border: 1px solid rgba(212, 175, 55, 0.2);
        color: #fff;
        margin-top: 50px;
        font-family: 'Poppins', sans-serif;
    }
    .review-section h2 {
        color: #D4AF37;
        font-family: 'Playfair Display', serif;
        margin-bottom: 30px;
        border-bottom: 2px solid #D4AF37;
        display: inline-block;
        padding-bottom: 5px;
    }
    .review-form {
        margin-bottom: 40px;
        padding: 25px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 15px;
    }
    .review-form input, .review-form textarea, .review-form select {
        width: 100%;
        padding: 12px;
        margin-bottom: 15px;
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(212, 175, 55, 0.3);
        color: #fff;
        border-radius: 8px;
    }
    .review-form input[type="file"] {
        background: transparent;
        border: none;
    }
    .review-form .btn-submit {
        background: #D4AF37;
        color: #002366;
        font-weight: bold;
        border: none;
        padding: 12px 30px;
        border-radius: 8px;
        cursor: pointer;
        transition: 0.3s;
    }
    .review-form .btn-submit:hover {
        background: #fff;
        transform: translateY(-2px);
    }
    .review-card {
        background: rgba(255, 255, 255, 0.05);
        padding: 20px;
        border-radius: 12px;
        margin-bottom: 20px;
        border-left: 4px solid #D4AF37;
    }
    .review-card .name {
        color: #D4AF37;
        font-weight: 600;
        margin-bottom: 5px;
    }
    .review-card .rating {
        color: #FFD700;
        margin-bottom: 10px;
    }
    .review-card .comment {
        font-size: 0.95rem;
        color: #e0e0e0;
        line-height: 1.6;
    }
    .review-card .date {
        font-size: 0.8rem;
        color: rgba(255, 255, 255, 0.5);
        margin-top: 10px;
    }
    .review-card img {
        margin-top: 15px;
        max-width: 200px;
        border-radius: 10px;
        display: block;
    }
    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 8px;
    }
    .alert-success { background: rgba(40, 167, 69, 0.2); border: 1px solid #28a745; color: #52e071; }
    .alert-danger { background: rgba(220, 53, 69, 0.2); border: 1px solid #dc3545; color: #ff6b7a; }
</style>

    <section class="review-section">
        <!-- MongoDB Connection Status Indicator -->
        <div style="font-size: 0.8rem; margin-bottom: 20px; text-align: right;">
            <?php if ($is_mongo_active): ?>
                <span style="color: #52e071;">● MongoDB Connected</span>
            <?php else: ?>
                <span style="color: #ff6b7a;">● MongoDB Disconnected (Check PHP Driver)</span>
            <?php endif; ?>
        </div>

        <h2>Customer Reviews</h2>
<?php if ($message): ?>
<div class="alert <?php echo strpos($message, 'Error') !== false || strpos($message, 'error') !== false || strpos($message, 'Invalid') !== false ? 'alert-danger' : 'alert-success'; ?>">
    <?php echo $message; ?>
</div>
<?php endif; ?>

    <div class="review-form">
        <h3 style="margin-bottom: 15px; color: #D4AF37;">Write a Review</h3>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
            <input type="text" name="reviewer_name" placeholder="Your Name" required>
            <select name="rating" required>
                <option value="">Select Rating</option>
                <option value="5">⭐⭐⭐⭐⭐ (5/5)</option>
                <option value="4">⭐⭐⭐⭐ (4/5)</option>
                <option value="3">⭐⭐⭐ (3/5)</option>
                <option value="2">⭐⭐ (2/5)</option>
                <option value="1">⭐ (1/5)</option>
            </select>
            <textarea name="comment" rows="4" placeholder="Your Feedback..." required></textarea>
            <p style="font-size: 0.9rem; color: #e0e0e0; margin-bottom: 5px;">Upload a photo of the product:</p>
            <input type="file" name="review_file">
            <button type="submit" name="submit_review" class="btn-submit">Post Review</button>
        </form>
    </div>

    <div class="reviews-list">
        <?php if (mysqli_num_rows($reviews_result) > 0): ?>
            <?php while ($review = mysqli_fetch_assoc($reviews_result)): ?>
                <div class="review-card">
                    <div class="name"><?php echo htmlspecialchars($review['reviewer_name']); ?></div>
                    <div class="rating">
                        <?php echo str_repeat('⭐', $review['rating']); ?>
                    </div>
                    <div class="comment"><?php echo nl2br(htmlspecialchars($review['comment'])); ?></div>
                    <?php if ($review['file_path']): ?>
                        <img src="<?php echo htmlspecialchars($review['file_path']); ?>" alt="Review photo">
                    <?php endif; ?>
                    <div class="date">Posted on <?php echo date('d M Y', strtotime($review['created_at'])); ?></div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p style="color: rgba(255,255,255,0.5);">No reviews yet. Be the first to review!</p>
        <?php endif; ?>
    </div>
</section>
