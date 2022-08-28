<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  require './register/register-process.php';
}
 ?>
<!-- Registration -->
<section id="register" style="height:600px;">
<div class="row m-0">
  <div class="col-lg-4 offset-lg-2">
    <div class="text-center pb-5">
      <h1 class="login-title text-dark">Register</h1>
      <p class="p-1 m-0 font-ubuntu text-black-50">Register and enjoy additional features</p>
      <span class="font-ubuntu text-black-50">I already have <a href="login.php">Login</a></span>
    </div>
    <div class="text-center pb-2">
      <small id="errors" class="text-danger text-center font-ubuntu"></small>
    </div>
    <div class="d-flex justify-content-center">
      <form class="" id="reg-form" action="./register.php" method="post" enctype="multipart/form-data">
        <div class="form-row">
          <div class="col">
            <input type="text" name="firstName" id="firstName" class="form-control" placeholder="First Name" value="<?=(isset($_POST['firstName']))?$_POST['firstName']:'';?>" required>
          </div>
          <div class="col">
            <input type="text" name="LastName" id="lastName" class="form-control" placeholder="Last Name" value="<?=(isset($_POST['LastName']))?$_POST['LastName']:'';?>" required>
          </div>
        </div>

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

        <div class="form-row my-4">
          <div class="col">
            <input type="password" name="confirm-pwd" id="confirm-pwd" class="form-control" placeholder="Confirm Password*" value="" required>
            <small id="confirm_error" class="text-danger"></small>
          </div>
        </div>

        <div class="form-check form-check-inline">
          <input type="checkbox" name="aggreement" class="form-check-input" required>
          <label for="aggreement" class="form-check-label font-ubuntu text-black-50">I agree <a href="#">term,conditions,and policy</a>(*)</label>
        </div>

        <div class="submit-btn text-center my-5">
          <button type="submit" class="btn btn-warning rounded-pill text-dark px-5">Continue</button>
        </div>
      </form>
    </div>
  </div>
</div>
</section>
<!-- !Registration -->
