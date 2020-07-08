<?php
require_once('class.config.php');



class User{

  private function Db(){ 

    $db = new mysqli('blwgc7trp0pjijtqilvu-mysql.services.clever-cloud.com', 'u3zhmix5sim1aj2d', '4cV0HTvOgyCpYLv3COo7','blwgc7trp0pjijtqilvu');

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

      return  $data = ['name'=> $value['MB_user_name'], 'id'=>$value['MB_user_id'],'profilePic'=>$value['MB_profile_pic']];

      }
    } else{
      return false;
    }

  }

  public function post_insert($title,$content,$user_id){
    $post_insert = new View();

    if(!empty($title) && !empty($content)){
      $insert = $post_insert->db->into('blog')->insert([
        'blog_title' => $title,
        'blog_content' => $content,
        'user_id' => $user_id
      ]);
        if($insert != true){
          return false;
        }else{
          return true;
        }

    } 
  }

  public function get_post($user_id){
    $view = new View();
    $query = $view->db->select('*')->from('blog')->where(['user_id'=> $user_id])->orderby('blog_id')->desc()->get();

    return $query;

  }


}

