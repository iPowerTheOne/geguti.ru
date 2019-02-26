<?php
define('EMAIL','1@1.ru');

class mail {
    static private $system=false;
    
    static public function init() {
        if (self::$system) return;
        
        self::$system=new static();
    }
    
    private function getPost($name) {
        $data=isset($_POST[$name]) ? $_POST[$name] : false;
        $data=filter_var($data,FILTER_SANITIZE_STRING);
        $data=trim($data);        
        return $data;
    }
    
    private function __construct() {
        $name=$this->getPost('name');
        $telephone=$this->getPost('telephone');
        $email=$this->getPost('email');
        $target=$this->getPost('target');
        
        if ($name && $telephone && $target) {
            $message='Тема: '.$target.'<br />';
            $message.='Имя: '.$name.'<br />';
            $message.='Телефон: '.$telephone.'<br />';
            if ($email) {
                $message.='EMail: '.$email.'<br />';
            }
            $headers='MIME-Version: 1.0'.PHP_EOL;
            $headers.='Content-type:text/html;charset=UTF-8'.PHP_EOL;
            mail(EMAIL,'Обратная связь: '.$target,$message,$headers);
        }
        
        header('location: thanks.html');
    }
    
}

mail::init();
?>