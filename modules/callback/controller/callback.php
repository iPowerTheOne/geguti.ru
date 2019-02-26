<?php
namespace callback\controller;

class callback extends \core\controller {
    
    public function action_default() {
        $name=$this->request->post('name');
        $email=$this->request->post('email');
        $file=$this->request->file('file');
        $comment=$this->request->post('comment');
        
        if ($name && $email) {
            $subject='Сообщение с сайта geguti.ru';
            $subject="=?UTF-8?B?".base64_encode($subject)."?=";
            $headers = "From: noreply@geguti.ru" . PHP_EOL;
            $headers .= "MIME-Version: 1.0" . PHP_EOL;            
            $this->view->set('name',$name);
            $this->view->set('email',$email);
            $this->view->set('comment',$comment);
            
            ob_start();
            $this->view->compile('callback');
            $message=ob_get_contents();
            ob_end_clean();
            
            $message=preg_replace('{[\r\n\t]}is','',$message);
            $message=trim($message);
            
            if ($file) {
                $content=file_get_contents($file['tmp_name']);
                $content=chunk_split(base64_encode($content));
                $separator=md5(microtime(true));
                
                $headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"" . PHP_EOL;
                $headers .= "Content-Transfer-Encoding: 7bit" . PHP_EOL;
                $headers .= "This is a MIME encoded message." . PHP_EOL;

                // message
                $body = "--" . $separator . PHP_EOL;
                $body .= "Content-Type: text/html; charset=\"utf-8\"" . PHP_EOL;
                $body .= "Content-Transfer-Encoding: 8bit" . PHP_EOL;
                $body .= $message . PHP_EOL;

                // attachment
                $body .= "--" . $separator . PHP_EOL;
                $body .= "Content-Type: application/octet-stream; name=\"" . $file['name'] . "\"" . PHP_EOL;
                $body .= "Content-Transfer-Encoding: base64" . PHP_EOL;
                $body .= "Content-Disposition: attachment" . PHP_EOL;
                $body .= $content . PHP_EOL;
                $message = $body. "--" . $separator . "--";                
            } else {
                $headers .= "Content-Type: text/html; charset=\"utf-8\"" . PHP_EOL;                            
            }
            
            mail('vb.win32@gmail.com',$subject,$message,$headers,'-fnoreply@geguti.ru');
            header('location: '.HOME.'/thanks.html',true,302);
        } else {
            header('location: '.HOME.'/',true,302);
        }        
    }
    
}
?>