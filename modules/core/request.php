<?php
namespace core;

class request {
    
    private function GetPost($name,$type,$filter='') {
        $result='';
        if ($type==1 && isset($_GET[$name])) {
            $result=$_GET[$name];
        } elseif ($type==2 && isset($_POST[$name])) {
            $result=$_POST[$name];
        }
        $result=filter_var($result,FILTER_SANITIZE_STRING);
        return $result;
    }
    
    public function get($name,$filter='') {
        return $this->GetPost($name,1,$filter);
    }
    
    public function post($name,$filter='') {
        return $this->GetPost($name,2,$filter);
    }
    
    public function file($name) {
        $result=false;
        
        if (isset($_FILES[$name]['tmp_name']) && file_exists($_FILES[$name]['tmp_name'])) {
            $result=$_FILES[$name];
        }
        
        return $result;
    }
    
}
?>