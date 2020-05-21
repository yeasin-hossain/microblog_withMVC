<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->
    <h2 class="active"> Sign In </h2>
    <h2 class="inactive underlineHover">Sign Up </h2>

    <!-- Icon -->
    <div class="fadeIn first">
      <img src="./assets/images/login_avater.svg" id="icon" alt="User Icon" />
    </div>
    <!-- Login Form -->
    <form action="loginverify" method="POST">
      <input name="MB_user_name" type="text" id="login" class="fadeIn second" name="login" placeholder="login">
      <input name="MB_password" type="text" id="password" class="fadeIn third" name="login" placeholder="password">
      <input type="submit" class="fadeIn fourth" value="Log In">
    </form>

    <!-- Remind Passowrd -->
    <div id="formFooter">
      <a class="underlineHover" href="#">Forgot Password?</a>
    </div>

  </div>
</div>
