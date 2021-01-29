<?php 

namespace app\Http\Models;

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
class Post 
{

    /**
     * Get all the posts as an associative array
     *
     * @return array
     */
    public static function getAll()
    {
        $host = 'mysql';
        $dbname = 'Bjornstad';
        $username = 'root';
        $password = 'root';

        try {
            $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

            $stmt = $db->query('SELECT id, title, content FROM posts ORDER BY created_at');

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $results;
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
}