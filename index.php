<?php
define('ABSPATH',dirname(__FILE__));

error_reporting(0);

include_once(ABSPATH.'/config.php');
include_once(ABSPATH.'/modules/core/router.php');
include_once(ABSPATH.'/router.php');

session_start();

class system {
    static private $system=false;
    
    static public function init() {
        if (self::$system) return;
        
        self::$system=new static();
        self::$system->execute();
    }
    
    private function __construct() {
        spl_autoload_register(array($this,'loader'));
        register_shutdown_function(array($this,'shutDownFunction'));
    }
    
    private function loader($class_name) {
        $filename=preg_replace('{[^a-z0-9_\\\]}is','',$class_name);
        $filename=trim($filename,'\\');
        $filename=preg_replace('{\\\}is','/',$filename);
        $filename=ABSPATH.'/modules/'.$filename.'.php';

        if (file_exists($filename)) {
            include_once($filename);
        }
    }
    
    public function shutDownFunction() {
        $error=error_get_last();
        if ($error['type']===E_ERROR) {
            $this->error($error['message']);
        }         
    }
    
    private function error($message) {
        if (DEBUG) {
            echo $message;
        } else {
            header('location: '.HOME.'/404.html');
        }        
    }
    
    private function execute() {
        try {
            $module=router::get();
            
            if ($module['module'] && $module['controller']) {
                $class_name=$module['module'].'\\controller\\'.$module['controller'];
                $method='action_'.$module['method'];
                
                $db=core\mysql::getInstance();
                \core\registry::set('db',$db);
                
                $module=new $class_name();
                
                if (!is_a($module,'\core\controller')) {
                    throw new Exception('Class '.$class_name.' instance error!');
                }
                
                if (!method_exists($module,$method)) {
                    throw new Exception('Method '.$method.' in class '.$class_name.' not exists!');
                }
                
                $module->$method();
            } else {
                throw new Exception('Class not found!');
            }
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }    
}

system::init();
?>