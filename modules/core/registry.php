<?php
namespace core;

class registry {
    static private $params=array();
    
    final static public function set($name,$value) {
        self::$params[$name]=$value;
    }
    
    final static public function get($name) {
        return isset(self::$params[$name]) ? self::$params[$name] : false;
    }
    
    final static public function remove($name) {
        if (isset(self::$params[$name])) {
            unset(self::$params[$name]);
        }
    }
}
?>