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

    public function home(){

        $data['title'] = 'Micro World';
        $data['page'] = 'home';
        $this->load('layout', $data);
    }

    public function signup(){
        $data['css'] = 'signup';
        $data['title'] = 'Join With Us';
        $data['page'] = 'signup';
        $this->load('layout',$data);
    }

}