<?php

// require MySQL Connection class...
require '../functions.php';

// get product details...
if (isset($_POST['itemid'])) {
  $result = $product->getProduct($_POST['itemid']);
  echo json_encode($result);
}

// update cart qty...
$prod_id = (isset($_POST['prod_id']))?$_POST['prod_id']:'';
$qty = (isset($_POST['qty']))?$_POST['qty']:'';

$con->query("UPDATE `cart` SET `qty`='$qty' WHERE items = '$prod_id' AND user_id = '$customer_id'");
 ?>
