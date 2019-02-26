<?php
namespace reviews\model;

class reviews extends \core\model {
    
    public function getReviews() {
        $arr=array();
        
        $res=$this->db->query('SELECT * FROM pre_reviews AS r ORDER BY r.review_order ASC');
        if ($res) {
            while($row=$this->db->fetch($res)) {
                $arr[]=$row;
            }
        }
        
        return $arr;
    }
    
}
?>