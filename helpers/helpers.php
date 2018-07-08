<?php
// libs
function view($view,$params=[]){
    $path = explode('::',$view);

    foreach(array_keys($params) as $name)
        ${$name.''} = $params[$name];

    require (__DIR__.'/../views/'.implode('/',$path).'.php');
}
function dump($p){
    echo '<pre>';
        var_dump($p);
    echo '</pre>';
}
function app(){
     return require_once __DIR__.'/../config/app.php';
}
function session ($name=null){
    $session = new \stdClass;
    $session->get = function ($name=null){
        if(!is_null($name))
            return $_SESSION[$name];
       return $_SESSION;
    };
    $session->set = function ($name,$val){
        $_SESSION = array_fill_keys(explode(',',$name),$val);
    };
    if($name) return $session->get($name);
    return $session;
}
function redirect($to){
    return exit(header("Location: {$to}"));
}