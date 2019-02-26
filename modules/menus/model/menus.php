<?php
namespace menus\model;

class menus extends \core\model {
    
    public function getMenu($id) {
        $arr=array();
        
        $res=$this->db->query('SELECT * FROM pre_menu_items AS i WHERE i.menu_id='.$id.' ORDER BY i.item_sort ASC');
        if ($res) {
            while($row=$this->db->fetch($res)) {
                $arr[]=$row;
            }
        }
        
        return $arr;
    }
    
}
?>