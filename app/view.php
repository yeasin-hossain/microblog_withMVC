<?php 

	#
#	Short View
#	Jafran Hasan
	#

class View extends Controller{

    public function login(){

        $data['css'] = 'login';
        $data['title'] = 'Login Please!';
        $data['page'] = 'login';
        $this->load('layout',$data);
    }

    public function home(){

        $data['title'] = 'Welcome to my  website';
        $data['page'] = 'home';
        $this->load('layout', $data);
    }

    public function loginverify(){

        $data['css'] = 'loginverify';
        $data['page'] = './php/loginverify';
        $this->load('layout', $data);
    }

}