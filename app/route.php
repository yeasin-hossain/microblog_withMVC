<?php 


	#
#	Short Routing Syetem
#	Jafran Hasan
    #
    

// $_self = $_SERVER;
define('ROUTE', isset($_SERVER['REDIRECT_QUERY_STRING']) ? trim($_SERVER['REDIRECT_QUERY_STRING'], '/') : 'home');
$_param = isset($_SERVER['REDIRECT_QUERY_STRING']) ? (explode('?', $_SERVER['REQUEST_URI'])[1] ?? false ) : ($_SERVER['QUERY_STRING'] ?? false);
parse_str($_param, $_param);
define('PARAM', $_param);
define('ROOT', str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));
define('HOME', 'https://'  . $_SERVER['HTTP_HOST'] . str_replace('index.php', '', $_SERVER['SCRIPT_NAME']));


// routes
$routes = [

    'home' => 'home',
    'login' => 'login',
    'logout' => 'logout',
    'signup' => 'signup',
    'api' => 'api'

];


// go route
if(array_key_exists(ROUTE, $routes)) {

    require_once __dir__ . '/controller.php';
    require_once __dir__ . '/view.php';
    
    if(method_exists('View', $routes[ROUTE])) {
        $out = new View();
        call_user_func(array($out, $routes[ROUTE]));
    } else {
        $out = false;
    }
    
} else {
    $out = false;
}



// execute

if($out === false){
    http_response_code(404);
    die('404 - route not found');
}

