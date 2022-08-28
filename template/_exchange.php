<?php
$error = array();
//Trade details
if (isset($_POST['submit'])) {
  $exg_name = ((isset($_POST['exg_name']) && $_POST['exg_name'] != '')?sanitize($_POST['exg_name']):'');
  if (empty($exg_name)) {
    $error[] = "You forgot to select your Exchange Name!";
  }
  //check coin existence in database.
  $count = $Trade_history->checkExistence($exg_name,'exchange_details','exchange_name');
  if ($count == True) {
    echo display_error($exg_name.' Already Exists!');
  }else {
  // check errors...
  if (empty($error)) {
      $query = "INSERT INTO `exchange_details`(`exchange_name`) VALUES ('$exg_name')";

    $run_query = $con->query($query);

    if ($run_query === true) {
      echo display_success('Your work has been saved','exchange.php');
    }else {
      echo display_error('Erroe while Placing Order...!');
    }

  }else {
    echo display_error('Please Enter Exchange Name!');
  }
 }
}
?>
<section class="home">
 <div class="container" id="form_bg">
   <h2 class="text-center my-2">Enter Exchange Name</h2><hr>
   <form action="#" method="post">
     <div class="col-md-6 py-2 m-auto">
       <label class="sr-only" for="exg_name">Exchange Name</label>
       <input type="text" class="form-control" name="exg_name" value="" placeholder="Enter Exchange Name" >
     </div>
     <div class="form-group m-auto py-2">
       <button type="submit" class="btn btn-primary mr-2" name="submit" style="width:150px;letter-spacing:2px;">Submit</button>
     </div>
   </form>
 </div>
</section>
