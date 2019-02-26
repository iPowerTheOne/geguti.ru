<?php
namespace portfolio\model;

class portfolio extends \core\model {
    
    public function getPortfolio() {
        $arr=array();
        
        $res=$this->db->query('SELECT * FROM pre_portfolio AS p ORDER BY p.portfolio_order ASC');
        if ($res) {
            while($row=$this->db->fetch($res)) {
                $row['portfolio_tags']=explode('|',$row['portfolio_tags']);
                $arr[]=$row;
            }
        }
        
        return $arr;
    }
    
}
?>