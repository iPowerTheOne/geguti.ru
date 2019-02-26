<?php
namespace home\controller;

class home extends \core\controller {
    
    public function action_default() {
        $this->loadModel('home','home');
        $this->loadModel('menus','menus');
        $this->loadModel('skills','skills');
        $this->loadModel('portfolio','portfolio');
        $this->loadModel('reviews','reviews');

        $options=$this->model_home_home->getOptions();        
        $menu=$this->model_menus_menus->getMenu(1);
        $skills=$this->model_skills_skills->getSkills();
        $portfolio=$this->model_portfolio_portfolio->getPortfolio();
        $reviews=$this->model_reviews_reviews->getReviews();
        
        $this->view->set('meta_title',$options['home_title']);
        $this->view->set($options);
        $this->view->set('menu',$menu);
        $this->view->set('skills',$skills);
        $this->view->set('portfolio',$portfolio);
        $this->view->set('reviews',$reviews);
        $this->view->compile('home_index');
    }
    
}
?>