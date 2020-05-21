<?php 


	#
#	Short Controller
#	Jafran Hasan
	#

abstract class Controller {


    public function __construct(){
        $this->db = new Database();
    }

    public function param($name = 'test', $default = false){
        
        if(array_key_exists($name, PARAM))
            return PARAM[$name];
        return $default;
    }  

    public function load($_pageName, $_vars = []){
        if(file_exists(ROOT . 'views/' . $_pageName . '.php')){
            if(is_array($_vars) && !empty($_vars)){
                extract($_vars);
            }
            include ROOT . 'views/' . $_pageName . '.php';
        }
    }




}