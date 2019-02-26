<?php
namespace pages\model;

class pages extends \core\model {
    
    public function getPage($name) {
        $result=false;
        
        $name=$this->db->escape($name);
        $res=$this->db->query('SELECT * FROM pre_pages AS p WHERE p.page_sef=\''.$name.'\' LIMIT 0,1');
        if ($res && ($row=$this->db->fetch($res))) {
            $result=$row;
        }
        
        return $result;
    }
    
}
?>