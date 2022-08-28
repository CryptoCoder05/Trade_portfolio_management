<?php

// Use to fetch product data...
class Product{
  public $db = null;
  public function __construct(DBController $db)
  {
    if (!isset($db->con)) {
      return null;
    }
    $this->db = $db;
  }

  //fetch product data using getData Method...
  public function getData($table = 'product'){
    $result = $this->db->con->query("SELECT * FROM {$table} WHERE featured = 1");
    $resultArray = array();

    // fetch product data one by one...
    while ($item = mysqli_fetch_assoc($result)) {
      $resultArray[] = $item;
    }
    return $resultArray;
  }

  //fetch child category id with category...
  public function get_Cat_Id($cat){
    $cat_res = $this->db->con->query("SELECT * FROM categories WHERE parent = '$cat'");
    $cat_res_Array = array();

    // fetch category data one by one...
    while ($cat_item = mysqli_fetch_assoc($cat_res)) {
      $cat_res_Array[] = $cat_item['id'];
    }
    return $cat_res_Array;
  }

  //fetch product data using getData Method...
  public function getProd($cat_id, $table = 'product'){
    $result = $this->db->con->query("SELECT * FROM {$table} WHERE featured = 1 AND categories = {$cat_id}");
    $resultArray = array();

    // fetch product data one by one...
    while ($item = mysqli_fetch_assoc($result)) {
      $resultArray[] = $item;
    }
    return $resultArray;
  }

  //fetch category name from categories...
  public function getCatName($cat_id, $table = 'categories'){
    $result = $this->db->con->query("SELECT * FROM {$table} WHERE id = '$cat_id'");
    $item = mysqli_fetch_assoc($result);
    return $item['categories'];
  }

  // get product using using item_id from cart...
  public function getProduct($item_id = null, $table = 'product'){
    if (isset($item_id)) {
      $result = $this->db->con->query("SELECT * FROM {$table} WHERE id = {$item_id}");

      $resultArray = array();

      // fetch product data one by one...
      while ($item = mysqli_fetch_assoc($result)) {
        $resultArray[] = $item;
      }
      return $resultArray;
    }
  }

  //fetch product data using category id Method...
public function getCatProd($catgoru_id,$table = 'product'){
  $result = $this->db->con->query("SELECT * FROM {$table} WHERE featured = 1 AND categories = $catgoru_id");
  $resultArray = array();

  // fetch product data one by one...
  while ($item = mysqli_fetch_assoc($result)) {
    $resultArray[] = $item;
  }
  return $resultArray;
}

  // get product size...
  public function getProdSize($size_arr){
    if (isset($size_arr)) {
      $sizestring = rtrim($size_arr,',');
      $size_array = explode(',',$sizestring);

      foreach($size_array as $string) {
        $string_array = explode(':', $string);
        $size = $string_array;
      }
      return $size;
    }
  }

  // update product size...
  public function updateSize($size_array,$qty,$prod_id){
    if (isset($qty)) {
      $size_arr = $this->getProdSize($size_array);
      $size_arr[0] = $size_arr[0];
      $size_arr[1] = $qty;
      $size_arr[2] = $size_arr[2];
      $sizes = implode(':', $size_arr);
      $result = $this->db->con->query("UPDATE `product` SET `sizes`='$sizes' WHERE id = '$prod_id'");
      return $result;
    }
  }

  // get product brand name...
  public function getBrand($prod_id){
    if (isset($prod_id)) {
      // get brand id from product...
      $result = $this->getProduct($prod_id,'product');
      $brand_id = $result[0]['brand'];

      // get brand name from brand...
      $result = $this->getProduct($brand_id,'brand');
      $brand_name = $result[0]['brand'];

      return $brand_name;
    }
  }

  // split search key in format of a|b|c and insert into search...
  public function getCatId($ser_key){
    $trim_data = trim($ser_key);
    $foo = preg_replace('/\s+/', ' ', $trim_data);
    $split_data = explode(" ",$foo);
    $search_pattern = implode("|",$split_data);
    $re = '/'.$search_pattern.'/mi';

    $cat_id_Array = array();
    $product = $this->getData();
    foreach ($product as $prod) {
      $title = $prod['title'];
      $match = preg_match($re, $title);
      if ($match) {
        $cat_id_Array[] = $prod['categories'];
      }
    }
    // insert search data into search database.
    if (!empty($cat_id_Array)) {
      $sql = "INSERT INTO `search` (`search_found`) VALUES ('$trim_data')";
      $result = $this->db->con->query($sql);
    }else {
      $sql = "INSERT INTO `search` (`search_not_found`) VALUES ('$trim_data')";
      $result = $this->db->con->query($sql);
    }
    // Return categories id.
    return $cat_id_Array;
  }

} // closing main class
 ?>
