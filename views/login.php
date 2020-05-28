<?php
require_once('class/class.user.php');

$wrn_msg = new Tamplate();
$wrn_msg->wrn_massage_show();

if(isset($_POST['MB_login'])){
  $Login = new User();
  $qu = $Login->login_user($_POST['MB_user_email'],$_POST['MB_password']);
  echo $qu['name'];
  if(!empty($qu)){
    $_SESSION['user_login'] = true;
    $_SESSION['user_id'] = $qu['name'];
    var_dump($qu);
    header('location: home');
  }else{
    echo 'password or email not match!';
    $wrn_msg->wrn_massage('Password or email not match! ','error');
    header('location: login');
    exit();
  } 
}



?>


<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->
    <h2 class="active"> Sign In </h2>
    <a class="inactive underlineHover"  href="signup">Sign Up</a>

    <!-- Icon -->
    <div class="fadeIn first">
      <img src="./assets/images/login_avater.svg" id="icon" alt="User Icon" />
    </div>
    <!-- Login Form -->
    <form action="login" method="POST">
      <input name="MB_user_email" type="text" id="login" class="fadeIn second" name="login" placeholder="Email@">
      <input name="MB_password" type="text" id="password" class="fadeIn third" name="login" placeholder="password">
      <input name="MB_login" type="submit" class="fadeIn fourth" value="Log In">

    </form>

    <!-- Remind Passowrd -->
    <div id="formFooter">
      <a class="underlineHover" href="#">Forgot Password?</a>
    </div>

  </div>
</div>
