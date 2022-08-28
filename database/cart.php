<?php
// php cart class...
class Cart
{
  public $db = null;
  public function __construct(DBController $db)
  {
    if (!isset($db->con)) {
      return null;
    }
    $this->db = $db;
  }

  // insert into cart table...
  public function insertIntoCart($params = null, $table="cart", $size,$seller_id){
    if ($this->db->con != null) {
      if ($params != null) {
        //get table columns...
        $columns = implode(',', array_keys($params));
        $values = implode(',', array_values($params));
        // Create sql query...
        $query_string = "INSERT INTO $table ($columns,size,seller_id) VALUES ($values,'$size','$seller_id')";

        // execute sql query...
        $result = $this->db->con->query($query_string);
        return $result;
      }
    }
  }

  // to get data and insert into cart table...
  public function addToCart($userid,$itemid,$size,$seller_id){
    if (isset($userid) && isset($itemid)) {
      $params = array(
        "user_id" => $userid,
        "items"   => $itemid
      );

      // insert data into cart...
      $result = $this->insertIntoCart($params, $table="cart", $size, $seller_id);
      if ($result === True) {
        // reload page...
        header("Location:".$_SERVER['PHP_SELF']);
      }
    }
  }

  // delete cart item using product id
  public function deleteCart($item_id = null, $table = 'cart',$customer_id = null){
    if ($item_id != null) {
      $result = $this->db->con->query("DELETE FROM {$table} WHERE items = {$item_id} AND user_id = '$customer_id'");
      if ($result) {
        header('Location:'.$_SERVER['PHP_SELF']);
      }
      return $result;
    }
  }

  // get item_id of shopping cart list
  public function getCartId($cartArray = null,$key = "items"){
    if ($cartArray != null) {
      $cart_id = array_map(function($value) use($key){
        return $value[$key];
      }, $cartArray);
      return $cart_id;
    }
  }

  // save for later
  public function saveForLater($item_id = null, $saveTable = "cart", $wishlist = null){
    if ($item_id != null) {
      $result = $this->db->con->query("UPDATE {$saveTable} SET `wishlist`={$wishlist} WHERE items = {$item_id}");
      if ($result === true) {
        header("Location=".$_SERVER['PHP_SELF']);
      }
      return $result;
    }
  }

  //fetch table data using where condition Method...
  public function getItem($table_name, $col_name, $condition){
    $result = $this->db->con->query("SELECT * FROM {$table_name} WHERE {$col_name} = {$condition}");
    $resultArray = array();

    // fetch product data one by one...
    while ($item = mysqli_fetch_assoc($result)) {
      $resultArray[] = $item;
    }
    return $resultArray;
  }

  //fetch table data using where , AND condition Method...
  public function getItemAnd($table_name, $col_name, $condition){
    $result = $this->db->con->query("SELECT * FROM {$table_name} WHERE {$col_name} = {$condition}");
    $resultArray = array();

    // fetch product data one by one...
    while ($item = mysqli_fetch_assoc($result)) {
      $resultArray[] = $item;
    }
    return $resultArray;
  }



}
 ?>
