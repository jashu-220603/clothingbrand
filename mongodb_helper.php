<?php
/**
 * MongoDB Helper for Mangalagiri Trends
 * Uses the native MongoDB PHP Driver (DLL only)
 */

class MongoDBHelper {
    private $manager = null;
    private $dbname = "mangalagiri_trends";

    public function __construct() {
        try {
            if (class_exists('MongoDB\Driver\Manager')) {
                $this->manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
            }
        } catch (Exception $e) {}
    }

    public function isConnected() {
        return $this->manager !== null;
    }

    public function insert($collection, $data) {
        if (!$this->isConnected()) return false;
        try {
            $bulk = new MongoDB\Driver\BulkWrite;
            $bulk->insert($data);
            $this->manager->executeBulkWrite("$this->dbname.$collection", $bulk);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function insertReview($data) {
        return $this->insert('reviews', $data);
    }

    public function getReviews($productId = null) {
        if (!$this->isConnected()) return [];
        
        try {
            $filter = $productId ? ['product_id' => $productId] : [];
            $options = ['sort' => ['created_at' => -1]];
            
            $query = new MongoDB\Driver\Query($filter, $options);
            $cursor = $this->manager->executeQuery("$this->dbname.reviews", $query);
            
            return $cursor->toArray();
        } catch (Exception $e) {
            return [];
        }
    }
}
?>
