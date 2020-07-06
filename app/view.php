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
            "name"=>"Shanto",
            "roll"=>"Shanto",
            "class"=>"Shanto",
            "nick"=>"Shanto"
        ];
        echo json_encode($data);
    }

}