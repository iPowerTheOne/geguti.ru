<?php
namespace core;

class mysql {
    static private $instance=false;
    private $link=false;
    private $qc=0;
    
    static public function getInstance() {
        if (self::$instance) return $instance;
        
        self::$instance=new static();
        return self::$instance;
    }
    
    private function __construct() {
        $this->link=@mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
        if (!$this->link) {
            throw new Exception('Could not connect to MySQL server!');
        }
        $this->query('SET NAMES utf8');
    }
    
    public function query($sql,array $arr=array()) {
        $sql=preg_replace('{pre_}is',DB_PREFIX,$sql);
        if (count($arr)) {
            foreach($arr as $k=>$v) {
                $k=':'.mysqli_real_escape_string($this->link,$k);
                $v=mysqli_real_escape_string($this->link,$v);
                $sql=preg_replace('{'.preg_quote($k).'}is',$v,$sql);
            }
        }
        $res=mysqli_query($this->link,$sql);
        
        if ($res) {
            $this->qc++;
        }
        
        return $res;
    }
    
    public function fetch($res) {        
        $row=mysqli_fetch_assoc($res);
        return $row;
    }
    
    public function qc() {
        return $this->qc;
    }
    
    public function escape($data) {
        return mysqli_real_escape_string($this->link,$data);
    }
    
    public function __destruct() {
        if ($this->link) {
            mysqli_close($this->link);
        }
    }
}
?>