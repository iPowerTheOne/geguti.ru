<?php
namespace skills\model;

class skills extends \core\model {
    
    public function getSkills() {
        $arr=array();
        
        $res=$this->db->query('SELECT * FROM pre_skills AS s ORDER BY s.skill_order ASC');
        if ($res) {
            while($row=$this->db->fetch($res)) {
                $arr[$row['skill_id']]=array('name'=>$row['skill_name'],'items'=>array());
            }
        }
        
        $res=$this->db->query('SELECT * FROM pre_skills_items AS i ORDER BY i.item_order ASC');
        if ($res) {
            while($row=$this->db->fetch($res)) {
                $arr[$row['skill_id']]['items'][]=$row;
            }
        }
        
        return $arr;
    }
    
}
?>