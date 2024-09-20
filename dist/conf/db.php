<?php
date_default_timezone_set("Asia/Kolkata");
class Database {

   private static $dbName = 'vgswvumy_guruproperties' ; 
   private static $dbHost = 'localhost' ;
   private static $dbUsername = 'vgswvumy_guruproperties';
   private static $dbUserPassword = 'uLIO;seh;=Mn';
   private static $cont  = null;
 
    public function __construct() {
        die('Init function is not allowed');
    }
    public static function connect()
    {
       // One connection through whole application
       if ( null == self::$cont )
       {      
        try
        {
          self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword);  
        }
        catch(PDOException $e) 
        {
          die($e->getMessage());  
        }
       } 
       return self::$cont;
    }
     
    public static function disconnect()
    {
        self::$cont = null;
    }
	
} 
?>