<?php
namespace core;

class model {
    private $params=array();
    
    public function __construct() {
        $this->params['db']=\core\registry::get('db');
    }
    
    public function __get($name) {
        return isset($this->params[$name]) ? $this->params[$name] : false;
    }    
}
?>