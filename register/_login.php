<?php
// session set during registration & login...
$user = array();
if (isset($_SESSION['userID'])) {
  $user = get_users_info($con,$_SESSION['userID']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  require './register/login-process.php';
}
 ?>
<!-- Registration -->
<section id="login-form" style="height:600px;">
<div class="row m-0 ">
  <div class="col-lg-4 offset-lg-2 ">
    <div class="text-center pb-5 ">
    <?php
    if (isset($_GET['success'])) {
     $reg_success = $_GET['success'];
     if($reg_success == 1){
      ?> <h3 class="text-success">Registration Successfull.</h3> <?php
     }
    }
    ?>
      <h1 class="login-title text-dark">Login</h1>
      <p class="p-1 m-0 font-ubuntu text-black-50">Login and enjoy additional features</p>
      <span class="font-ubuntu text-black-50">Create a new <a href="register.php">account</a></span>
    </div>
    <div class="text-center pb-2">
      <small id="errors" class="text-danger text-center font-ubuntu"></small>
    </div>
    <div class="d-flex justify-content-center">
      <form class="" id="log-form" action="./login.php" method="post" enctype="multipart/form-data">
        <div class="form-row my-4">
          <div class="col">
            <input type="email" name="email" id="email" class="form-control" placeholder="Email*" value="<?=(isset($_POST['email']))?$_POST['email']:'';?>" required>
          </div>
        </div>

        <div class="form-row my-4">
          <div class="col">
            <input type="password" name="password" id="password" class="form-control" placeholder="Password*" value="" required>
          </div>
        </div>

        <div class="submit-btn text-center my-5">
          <button type="submit" class="btn btn-warning rounded-pill text-dark px-5">Login</button>
        </div>
      </form>
    </div>
  </div> <!-- !main col -->
</div> <!-- !main row -->
</section>
<!-- !Registration -->
