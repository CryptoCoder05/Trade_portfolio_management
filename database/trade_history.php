<?php

// php Trade History class...
class TradeHistory
{
  public $db = null;
  public function __construct(DBController $db)
  {
    if (!isset($db->con)) {
      return null;
    }
    $this->db = $db;
  }

// get coin name for select option...
  public function getCoinName($table,$alfa){
    if ($this->db->con != null) {
      if (isset($table)) {
      $coin_Q = "SELECT * FROM $table ORDER BY $alfa";
      $coin_res = $this->db->con->query($coin_Q);
      $resultArray = array();
      while ($result = mysqli_fetch_assoc($coin_res)) {
        $resultArray[] = $result;
      }
      return $resultArray;
     }
    }
  }

// get coin name from coin id...
  public function getAssetName($table,$id){
    if ($this->db->con != null) {
      if (isset($id)) {
      $coin_Q = "SELECT * FROM $table WHERE id = '$id'";
      $coin_res = $this->db->con->query($coin_Q);
      $resultArray = array();
      while ($result = mysqli_fetch_assoc($coin_res)) {
        $resultArray[] = $result;
      }
      return $resultArray;
     }
    }
  }

// get coin id from coin name...
  public function getAssetDetails($table,$n){
    if ($this->db->con != null) {
      if (isset($n)) {
      $coin_Q = "SELECT * FROM $table WHERE coin_name = '$n' || short_name = '$n'";
      $coin_res = $this->db->con->query($coin_Q);
      $resultArray = array();
      while ($result = mysqli_fetch_assoc($coin_res)) {
        $resultArray[] = $result;
      }
      return $resultArray;
     }
    }
  }

// get report for table in portfolio...
  public function getRecords($asset_id, $table = 'trade_history'){
    if ($this->db->con != null) {
      if (isset($asset_id)) {
      $Query = "SELECT * FROM $table WHERE coin_id = '$asset_id'";
      $res = $this->db->con->query($Query);
      $resultArray = array();
      while ($result = mysqli_fetch_assoc($res)) {
        $resultArray[] = $result;
      }
      return $resultArray;
     }
    }
  }

// Check data existence in database...
  public function checkExistence($name, $table, $field){
    if ($this->db->con != null) {
      if (isset($name)) {
      $Query = "SELECT * FROM $table WHERE $field = '$name'";
      $res = $this->db->con->query($Query);
      $count = mysqli_num_rows($res);
      if ($count != 0) {
        return True;
      }else {
        return False;
      }
     }
    }
  }

// get coin name for dashBoard...
  public function getData($table){
    if ($this->db->con != null) {
      if (isset($table)) {
      $Query = "SELECT * FROM $table";
      $res = $this->db->con->query($Query);
      $resultArray = array();
      while ($result = mysqli_fetch_assoc($res)) {
        $resultArray[] = $result;
      }
      return $resultArray;
     }
    }
  }

// get report for dashBoard...
  public function dashBoard($c,$table){
    if ($this->db->con != null) {
      if (isset($table)) {
      $Query = "SELECT * FROM $table WHERE coin_id = '$c'";
      $res = $this->db->con->query($Query);
      $resultArray = array();
      while ($result = mysqli_fetch_assoc($res)) {
        $resultArray[] = $result;
      }
      return $resultArray;
     }
    }
  }


}// End of main class.
 ?>
