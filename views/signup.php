<?php 
require_once('class/class.user.php');


if(isset($_POST['MB_signup'])){
    $user_name = $_POST['MB_user_name'];
    $user_pass = $_POST['MB_password'];
    $user_pic = '';
    $email = $_POST['MB_user_email'];
// for uload the photo to dir
    $file = $_FILES['profile_pic'];
      $up = move_uploaded_file($file['tmp_name'], ROOT .'assets/userdata/' . $file['name']);
        if($up){
            $user_pic = $_FILES['profile_pic']['name'];
        }

    $signup = new User();
    $wrn_msg = new Tamplate();
    $qu = $signup->register($user_name,$user_pass,$email,$user_pic);
    echo $qu;
    if($qu == 1){
        
        header('location: login');
        exit();
    }else{
        $wrn_msg->wrn_massage_show();
       // header('location: signup');
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
