<?php 

	#
#	Short View
#	Jafran Hasan
    #
require_once(ROOT .'views/class/class.config.php');
    class View extends Controller{

    public function login(){

        $data['css'] = 'login';
        $data['title'] = 'Login Please!';
        $data['page'] = 'login';
        $this->load('layout',$data);
    }
    public function logout(){
        $data['page'] = 'logout';
        $this->load('layout',$data);
    }
    public function home(){
        
        if(isset($_SESSION['user_login'])){
        $data['title'] = 'Micro World ' . $_SESSION['user_id'] ;
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

}