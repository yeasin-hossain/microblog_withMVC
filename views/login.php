
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
      <input name="MB_user_name" type="text" id="login" class="fadeIn second" name="login" placeholder="User Name">
      <input name="MB_password" type="text" id="password" class="fadeIn third" name="login" placeholder="password">
      <input name="MB_login" type="submit" class="fadeIn fourth" value="Log In">

    </form>

    <!-- Remind Passowrd -->
    <div id="formFooter">
      <a class="underlineHover" href="#">Forgot Password?</a>
    </div>

  </div>
</div>
