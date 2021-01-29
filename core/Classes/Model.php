<?php 

namespace core\Classes;

use PDO;
use PDOException;

/** 
 * Bjornstad
 * @Author Luke McCann
 * 
 * Model
 * 
 * PHP Version 8.0
 */
abstract class Model 
{
    
    /**
     * Get PDO database connection 
     * 
     * @return mixed
     */
    protected static function getConnection() 
    {
        static $db = null;

        if ($db !== null) return;

        $host = 'mysql';
        $dbname = 'Bjornstad';
        $username = 'root';
        $password = 'root';
        $dsn = "mysql:host=$host;dbname=$dbname;";

        $options = [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_CLASS,
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        try {
            $db = new PDO($dsn, $username, $password, $options);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
        return $db;
    }
}