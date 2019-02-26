<?php
namespace core;

class view {
    private $params=array();
    
    public function set($name,$value) {
        if (is_array($name) && is_array($value) && count($name)==count($value)) {
            $arr=array_combine($name,$value);
            $this->params=array_merge($this->params,$arr);
        } elseif (is_array($name)) {
            $this->params=array_merge($this->params,$name);
        } elseif ($name) {
            $this->params[$name]=$value;
        }
    }
    
    public function get($name) {
        return isset($this->params[$name]) ? $this->params[$name] : false;
    }
    
    public function compile($name) {
        $name=preg_replace('{[^a-z0-9_\/]}is','',$name);
        $filename=ABSPATH.'/templates/'.$name.'.html';
        
        if (file_exists($filename)) {
            include_once($filename);
        }
    }    
}
?>