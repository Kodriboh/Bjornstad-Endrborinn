<?php 

namespace app\Http\Models;

use core\Classes\Model;
use PDO;
use PDOException;

/** 
 * Bjornstad
 * @Author Luke McCann
 * 
 * Post Model
 * 
 * PHP Version 8.0
 */
class Post extends Model
{

    /**
     * Get all the posts as an associative array
     *
     * @return array
     */
    public static function getAll()
    {


        try {
            $db = static::getConnection();
            
            $stmt = $db->query('SELECT id, title, content FROM posts ORDER BY created_at');

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $results;
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
}