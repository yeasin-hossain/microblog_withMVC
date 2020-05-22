<?php
require_once('class.config.php');



class User{

  private function Db(){ 

    $db = new mysqli('localhost', 'root', '','microblog');

      if($db->connect_error){
        die('Database Issue!');
        } else {
            return $db;
          }
  }

  public function register($user_name,$password,$email,$profile_pic){
    $db = $this->db();
    $tamplate = new Tamplate();

    if(!empty($user_name) && !empty($password) && !empty($profile_pic)){
      $sql = "INSERT INTO `users` ( `MB_user_name`, `MB_user_email`, `MB_user_pass`, `MB_profile_pic`) VALUES ('$user_name', $email, '$password', '$profile_pic') ";
        if($result = $db->query($sql)){

          return true;

        }else{
          return $tamplate->wrn_massage('Maybe You Already Joined With US!','info');
        }
    }else{
      return $tamplate->wrn_massage('Please Fill Full!','error');
    }

  }


  public function loginValide(){
    $db = $this->db();
    $sql = "SELECT * FROM users";
    $result = $db->query($sql);
    $data = $result->fetch_assoc();
    echo $data['MB_user_name'];
  }


}

