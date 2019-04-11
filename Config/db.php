<?php 

class Database 
{
  
  private static $instance = null;

  private function __construct() {}

  public static function getInstance()
  {
    if (is_null(self::$instance)) {
      self::$instance = new PDO('mysql:host=localhost;dbname=book_catalog', 'root', '');
    }

    return self::$instance;
  }

}

?>