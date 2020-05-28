<?php 
require_once('class/class.user.php');

if(isset($_POST['MB_signup'])){
    $user_name = $_POST['MB_user_name'];
    $user_pass = $_POST['MB_password'];
    $email = $_POST['MB_user_email'];
    $file = $_FILES['profile_pic'];

    $signup = new User();
    $wrn_msg = new Tamplate();
    $user_pic = $wrn_msg->img_upload($file);
    $qu = $signup->register($user_name,$user_pass,$email,$user_pic);
    if($qu == 1){
        
        header('location: login');
    }else{
      //$wrn_msg->wrn_massage('Please Fill Full!','error');
     // header('location: signup');
     exit();
    }
}


?>


<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->
    <h2 class="active"> Sign Up </h2>
    <a class="inactive underlineHover"  href="login">Sign In</a>
   

    <!-- Icon -->
    <div class="fadeIn first">
      <img src="./assets/images/signup.svg" id="icon" alt="User Icon" />
    </div>
    <!-- Login Form -->
    <form action="signup" method="POST"enctype="multipart/form-data">
      <input name="profile_pic" type="file" class="fadeIn first" placeholder="Full Name">
      <input name="MB_user_name" type="text" class="fadeIn second" placeholder="Full Name" >
      <input name="MB_user_email" type="text" class="fadeIn second" placeholder="Email@">
      <input name="MB_password" type="text" class="fadeIn third" placeholder="password">
      <input name="MB_signup" type="submit" class="fadeIn fourth" value="Sign Up">

    </form>

  </div>
</div>
