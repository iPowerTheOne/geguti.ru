<?php
namespace core;

class controller {
    private $params=array();
    
    public function __construct() {
        $this->params['request']=new \core\request();
        $this->params['view']=new \core\view();        
    }
    
    public function loadModel($module,$model) {
        $class_name='\\'.$module.'\\model\\'.$model;
        $this->params['model_'.$module.'_'.$model]=new $class_name();        
    }
    
    public function loadController($module,$model) {
        $class_name='\\'.$module.'\\controller\\'.$model;
        $this->params['controller_'.$module.'_'.$model]=new $class_name();        
    }
    
    public function __get($name) {
        return isset($this->params[$name]) ? $this->params[$name] : false;
    }    
}
?>