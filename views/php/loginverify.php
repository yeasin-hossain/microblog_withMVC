<?php



class Login{

  private function Db(){ 

    $db = new mysqli('localhost', 'root', '','microblog');

      if($db->connect_error){
        die('Database Issue!');
        }else{
          return $db;
      }
}

  public function __construct(){
    if(isset($_POST['MB_login'])):
      $userName = $_POST['MB_user_name'];
      $password = $_POST['MB_password'];
      if($userName==10){
       // header('location: home');
      }else{
        header('location: login');
      }
    else:
          echo 'none';
    endif;
  }


  public function loginValide(){
    $db = $this->db();
    $sql = "SELECT * FROM users";
    $result = $db->query($sql);
    $data = $result->fetch_assoc();
    echo $data['MB_user_name'];
  }


}



$cla = new Login();

echo $cla->loginValide();