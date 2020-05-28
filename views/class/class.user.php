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
     $view = new View();
     $query = $view->db->into('users')->insert([
        'MB_user_name' => $user_name,
        'MB_user_email' => $email,
        'MB_user_pass' => $password,
        'MB_profile_pic' => $profile_pic
     ]);
      if($query == 0){

        $tamplate->wrn_massage('Maybe You Already Joined With US!','info');
        return $tamplate->wrn_massage_show();
        }else{
          return true;
        }
    }else{
      $tamplate->wrn_massage('Please Fill Full!','error');
      return $tamplate->wrn_massage_show();
      exit();
    }

  }


  public function login_user($user_email,$user_pass){
    $view = new View();

    if(!empty($user_email)&&!empty($user_pass)){

      $query = $view->db->select('*')->from('users')->where(['MB_user_email'=>$user_email,
      'MB_user_pass'=>$user_pass])->get();

      foreach ($query as $value) {
        //return $value['MB_user_name'];
     //   return $value['MB_user_email'];
      return  $data = ['name'=> $value['MB_user_name'], 'id'=>$value['MB_user_id']];

      }
    } else{
      return false;
    }

  }

}

