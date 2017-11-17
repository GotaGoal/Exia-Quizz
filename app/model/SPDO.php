<?php
 
class SPDO
{
  private $PDOInstance = null;
  private static $instance = null;

  private function __construct()
  {
      $this->PDOInstance = new PDO('mysql:host=ordiassiste.com:2082;dbname=ordiassi_quizz;charset=utf8', 'ordiassi_admin', 'Kfixwoax68', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  }

  public static function getInstance()
  {
    if(is_null(self::$instance))
    {
      self::$instance = new SPDO();
    }
    return self::$instance;
  }
  public function getPDO(){
    return $this->PDOInstance;
  }
  
}
?>