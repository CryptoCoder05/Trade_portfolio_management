<?php

// Transaction class...
class Transaction
{
  public $db = null;
  public function __construct(DBController $db)
  {
    if (!isset($db->con)) {
      return null;
    }
    $this->db = $db;
  }

  // get data from transactions table...
  public function getOrder($cus_id){
    if (isset($cus_id)) {
      $query = "SELECT * FROM transactions WHERE customer_id = '$cus_id'";
      $run = $this->db->con->query($query);
      $resultArray = array();
      while ($result = mysqli_fetch_assoc($run)) {
        $resultArray[] = $result;
      }
      return $resultArray;
    } // closing if condition...
  } // closing getOrder method...
} // closing of main class
 ?>
