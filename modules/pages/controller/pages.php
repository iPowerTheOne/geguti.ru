<?php
namespace pages\controller;

class pages extends \core\controller {
    
    public function action_default() {
        $this->loadModel('pages','pages');
        $this->loadModel('menus','menus');
        
        $name=$this->request->get('name');
        $page=$this->model_pages_pages->getPage($name);
        $menu=$this->model_menus_menus->getMenu(1);
        
        if ($page) {
            $this->view->set($page);
            $this->view->set('menu',$menu);
            $this->view->compile('page');
        } else {
            header('location: '.HOME.'/404.html');
        }        
    }
    
}
?>