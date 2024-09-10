<?php
date_default_timezone_set("Asia/Kolkata");
class Database {

  //    private static $dbName = 'a1622dey_guru' ; 
  //  private static $dbHost = 'localhost' ;
  //  private static $dbUsername = 'a1622dey_guru';
  //  private static $dbUserPassword = 'mF%l4TD29rAS';
  //  private static $cont  = null;
  //  ------------------------------------------------------------
  

  // private static $dbName = 'guru_enterprises_nr'; 
  private static $dbName = 'guru_seqpro'; 
  // private static $dbName = 'guru_enterprises_gayatri'; 
  private static $dbHost = 'localhost';
  private static $dbUsername = 'root';
  private static $dbUserPassword = '';
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