<?php
namespace App\Handler;

use Phalcon\Mvc\Dispatcher;
use Phalcon\Events\Event;
use Users;

class NotificationListener{
 
    public function beforeHandleRequest(Event $event , \Phalcon\Mvc\Application $application , Dispatcher $containerspatcher){
        
        
        $aclFile = APP_PATH.'/security/acl.cache';
        if(true === is_file($aclFile)){
            
            $acl = unserialize(
                file_get_contents($aclFile) 
            );
            $role = $application->request->get("role");
            $users = Users::findFirst("role = '$role'");
            $controller = $containerspatcher->getControllerName();
           $action     = $containerspatcher->getActionName();
           if(!$action){
               $action="index";
           }
            if( !$role || true !== $acl->isAllowed($role,$controller,$action)){
                echo "Access Denied ";
                die;
            }
            
        }
        else{
               echo "can't find any acl file";
           die; 
        }
        
       
    }

}