<?php
$error = array();
//Trade details
if (isset($_POST['submit'])) {
  $coin_name = ((isset($_POST['full_coin_name']) && $_POST['full_coin_name'] != '')?sanitize($_POST['full_coin_name']):'');
  if (empty($coin_name)) {
    $error[] = "You forgot to enter your coin Name!";
  }

  $short_name = ((isset($_POST['short_name']) && $_POST['short_name'] != '')?sanitize($_POST['short_name']):'');
  if (empty($short_name)) {
    $error[] = "You forgot to enter short Name!";
  }
  //check coin existence in database.
  $count = $Trade_history->checkExistence($coin_name,'coin_details','coin_name');
  $short_count = $Trade_history->checkExistence($short_name,'coin_details','short_name');
  if ($short_count == True) {
    $error[] = $short_name.' Already Exists!';
  }
  if ($count == True) {
    echo display_error($coin_name.' Already Exists!');
  }else {
    // check errors...
    if (empty($error)) {
        $query = "INSERT INTO `coin_details`(`coin_name`,`short_name`) VALUES ('$coin_name','$short_name')";

      $run_query = $con->query($query);

      if ($run_query === true) {
        echo display_success($coin_name.' has been saved','add_coin.php');
      }else {
        echo display_error('Something went wrong!');
      }

    }else {
      echo display_error('All field are required!');
    }
  }
}
?>
<section class="home">
 <div class="container" id="form_bg">
   <h2 class="text-center my-2">Enter Coin Name</h2><hr>
   <form action="#" method="post">
     <div class="form-row">
       <div class="col-md-1 py-2"></div>
       <div class="col-md-6 py-2">
         <label class="sr-only" for="full_coin_name">Enter full Coin Name</label>
         <input type="text" class="form-control" name="full_coin_name" value="" placeholder="Enter full Coin Name. eg. Bitcoin" >
       </div>
       <div class="col-md-4 py-2">
         <label class="sr-only" for="short_name">Enter short name</label>
         <input type="text" class="form-control" name="short_name" value="" placeholder="Enter short name. eg. BTC" >
       </div>
       <div class="col-md-1 py-2"></div>
     </div>
     <div class="form-row">
       <div class="m-auto py-2">
         <button type="submit" class="btn btn-primary mr-2" name="submit" style="width:150px;letter-spacing:2px;">Submit</button>
       </div>
     </div>
   </form>
 </div>
</section>
