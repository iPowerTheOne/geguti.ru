<?php
class router {
    static private $params=array();
    
    static public function add($preg,$path) {
        self::$params[]=array($preg,$path);
    }
    
    static public function get() {
        $arr=array('module'=>'','controller'=>'','method'=>'');
        
        $uri=strtolower($_SERVER['REQUEST_URI']);
        if (HOME) {
            $home=preg_quote(HOME);
            $uri=preg_replace('{^'.$home.'}is','',$uri);
        }
        $uri=trim($uri,'/');
        $uri=$uri ? $uri : 'index.html';
        
        foreach(self::$params as $v) {
            $preg='{'.$v[0].'}is';
            
            $params=array();
            if (preg_match_all('{\sas\s([a-z0-9_]+)}is',$preg,$match)) {
                foreach($match[0] as $m=>$n) {
                    $preg=str_replace($n,'',$preg);
                    $params[]=$match[1][$m];
                }
            }
            
            if (preg_match($preg,$uri,$match)) {
                $module=explode('/',$v[1]);
                if (count($module)==3) {
                    $arr['module']=$module[0];
                    $arr['controller']=$module[1];
                    $arr['method']=$module[2];
                    
                    if (count($match)) {
                        unset($match[0]);
                        if (count($match)==count($params)) {
                            $_GET=array_combine($params,$match);
                        }
                    }
                }
                break;
            }
        }
        
        return $arr;
    }
}
?>