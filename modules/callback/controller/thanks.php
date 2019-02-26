<?php
namespace callback\controller;

class thanks extends \core\controller {
    
    public function action_default() {
        $this->view->set('meta_title','Спасибо!');
        $this->view->compile('thanks');
    }
    
}
?>