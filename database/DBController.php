<?php
session_start();
// local connection
 $user = 'root';
 $host = 'localhost';
 $password = '';
 $database = 'crypto_portfolio_old';

try {
  $con = new mysqli($host,$user,$password,$database);
} catch (Exception $ex) {
  print "An Exception occurred. Message:".$ex->getMessage();
} catch(Error $e){
  print "The system is busy please try later";
}


// class connection..
class DBController{
  // Database Connection properties
  protected $host = 'localhost';
  protected $user = 'root';
  protected $password = '';
  protected $database = 'crypto_portfolio_old';

  // connection property
  public $con = null;

  // call constructor
  public function __construct()
  {
   $this->con = mysqli_connect($this->host,$this->user,$this->password,$this->database);
   if ($this->con->connect_error) {
     echo "fail".$this->con->connect_error;
   }
  }

public function __destruct()
{
  $this->closeConnection();
}

  // for mysqli closing connection
  protected function closeConnection(){
    if ($this->con != null) {
      $this->con->close();
      $this->con = null;
    }
  }
}


// global data...
if (isset($_SESSION['login'])) {
  $user_id = $_SESSION['login'];
  $customer_id = $_SESSION['login'];
}else {
  $user_id = '0';
  $customer_id = '0';
}
