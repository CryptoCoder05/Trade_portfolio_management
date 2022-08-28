<?php

// sanatize input string
function sanitize($textValue){
  if (!empty($textValue)) {
    $trim_text = trim($textValue);
    $sanitize_str = filter_var($trim_text,FILTER_SANITIZE_STRING);
    return $sanitize_str;
  }
  return '';
}

// sanatize input email
function sanitize_email($emailValue){
  if (!empty($emailValue)) {
    $trim_text = trim($emailValue);
    $sanitize_str = filter_var($trim_text,FILTER_SANITIZE_EMAIL);
    return $sanitize_str;
  }
  return '';
}

function display_error($error_data){
    ?>
    <script>
      Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: '<?=$error_data;?>!'
      });
    </script>
    <?php
}

function display_msg($msg){
?>
<script>
$(document).ready(function() {
  var errors = '<?= $msg; ?>';
  $("#errors").text(errors);
});
</script>
<?php
}

// check if success and redirect to index...
function display_success($msg,$loc){
?>
<script>
Swal.fire({
 position: 'top-center',
 icon: 'success',
 title: '<?=$msg; ?>',
 showConfirmButton: false,
 timer: 1500
});
window.setTimeout(function(){
window.location.href = "<?=$loc;?>";
}, 1300);
</script>
<?php
}

// check if login or not...
function is_login(){
  if (isset($_SESSION['login'])) {
    $_SESSION['login'];
    return true;
  }else {
    return false;
  }
}

// redirect location...
function redirect($path){
  header('Location:'.$path);
}

// money formate...
function money($number){
  return 'Rs. '.number_format($number,3);
}

// qty formate...
function qty($number){
  return number_format($number,4);
}

function pretty_date($date){
  return date("M d, Y",strtotime($date));
}
?>
