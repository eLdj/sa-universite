<?php 

class Database
{
    
   private static $dbHost = "localhost";
   private static $dbName = "";
   private static $dbUser = "eldji";
   private static $dbUserPassword = "Eldji@92f";
   private static $connection = null;


    public static function connect($dbNames)
    {
        self::$dbName = $dbNames;
        try
        {
            self::$connection = new PDO("mysql:host=".self::$dbHost.";dbname=".self::$dbName.";charset=utf8",self::$dbUser,self::$dbUserPassword);
            self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }
        catch(PDOException $e){
            die('Erreur: '.$e ->getMessage());
        }
        return self::$connection;
    }

    public static function disconnect()
    {
        self::$connection = null;
    }
}   