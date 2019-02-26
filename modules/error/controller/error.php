<?php
namespace error\controller;

class error extends \core\controller {
    
    public function action_404() {
        header("HTTP/1.0 404 Not Found",true,404);        
        $this->view->set('meta_title','404 - Страница не найдена!');
        $this->view->compile('404');
    }
    
}
?>