<?php
class Loader{
    static function register(){
        spl_autoload_register(array(__CLASS__,'autoload'));
    }
    static function autoload($class_name){
        require_once $class_name.'.php';
    }

}


?>