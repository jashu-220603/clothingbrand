# MongoDB Compass Setup Guide for Mangalagiri Trends

MongoDB Compass is a powerful GUI for interacting with your MongoDB data. Follow these steps to set it up and connect it to your project.

## 1. Installation
If you haven't installed it yet, download it from the official website:
[Download MongoDB Compass](https://www.mongodb.com/try/download/compass/mongodb-compass)

## 2. Connecting to Local MongoDB
If you are running MongoDB locally (usually on port 27017):
1. Open MongoDB Compass.
2. Click on **"New Connection"**.
3. In the **Connection String** field, paste:
   ```
   mongodb://localhost:27017
   ```
4. Click **Connect**.

## 3. Integrating with PHP
To use MongoDB with your website, you need the PHP MongoDB extension.

### For XAMPP (Windows):
1. Download the `php_mongodb.dll` from [PECL](https://pecl.php.net/package/mongodb). Make sure to match your PHP version and architecture (x64/x86).
2. Copy the `.dll` file to your `C:\xampp\php\ext` folder.
3. Edit your `php.ini` file (found in `C:\xampp\php\php.ini`).
4. Add this line:
   ```ini
   extension=mongodb
   ```
5. Restart Apache in the XAMPP Control Panel.

## 4. Using the project's MongoDB Helper
I have added a `mongodb_helper.php` file to your project. You can use it like this:

```php
require_once 'mongodb_helper.php';
$mongo = new MongoDBHelper();

if ($mongo->isConnected()) {
    echo "Connected to MongoDB!";
    // Example: Fetch reviews
    $reviews = $mongo->getReviews('saree1');
} else {
    echo "MongoDB not connected. Please check your extension and service.";
}
```

## 5. Why use MongoDB?
- **Flexible Schema**: Perfect for product attributes that vary between items (e.g., sarees vs shirts).
- **Performance**: High-speed reads for reviews and catalogs.
- **Scalability**: Easily handle thousands of customer reviews without slowing down.
