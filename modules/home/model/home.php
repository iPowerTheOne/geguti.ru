<?php
namespace home\model;

class home extends \core\model {
    
    public function getOptions() {
        $arr=array();
        
        $res=$this->db->query('SELECT * FROM pre_home AS h');
        if ($res) {
            while($row=$this->db->fetch($res)) {
                $arr[$row['option_name']]=$row['option_value'];
            }
        }
        
        $arr['stack']=explode('|',$arr['stack']);
        
        return $arr;
    }
}

?>