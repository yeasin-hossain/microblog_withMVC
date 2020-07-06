<?php 

	#
#	Short View
#	Jafran Hasan
    #
require_once(ROOT .'views/class/class.config.php');
    class View extends Controller{

    public function login(){
        if(isset($_SESSION['user_login'])!= true){
            $data['css'] = 'login';
            $data['title'] = 'Login Please!';
            $data['page'] = 'login';
            $this->load('layout',$data);
        }else{
            header('location: home');
        }
    }
    public function logout(){
        $data['page'] = 'logout';
        $this->load('layout',$data);
    }
    public function home(){

        if(isset($_SESSION['user_login'])){
        $data['css'] = 'home';
        $data['title'] = $_SESSION['user_name'] .' in Micro World' ;
        $data['page'] = 'home';
        $this->load('layout', $data);

        }else{
            header('location: login');
        }
    }

    public function signup(){

        $data['css'] = 'signup';
        $data['title'] = 'Join With Us';
        $data['page'] = 'signup';
        $this->load('layout',$data);

    }
    public function api(){
        $data = [
            
        "id"=> 2,
        "trip_id"=> 3,
        "a1"=> 1,
        "a2"=> 0,
        "a3"=> 1,
        "a4"=> 0,
        "b1"=> 1,
        "b2"=> 0,
        "b3"=> 1,
        "b4"=> 0,
        "c1"=> 1,
        "c2"=> 1,
        "c3"=> 0,
        "c4"=> 0,
        "d1"=> 1,
        "d2"=> 0,
        "d3"=> 0,
        "d4"=> 0
        ];
        echo json_encode($data);
    }

}