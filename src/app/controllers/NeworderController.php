<?php

use Phalcon\Mvc\Controller;
use Phalcon\Events\Manager as EventsManager;


class NeworderController extends Controller
{
    public function indexAction()
    {
    
    }
    public function placenewAction(){
        $orders= new Orders();
        
        $eventsManager = new EventsManager();
        $component = new \App\Components\Aware();
        $component->setEventsManager($eventsManager);

        $orders->assign([
         'cname' => $this->request->getPost('cname'),
         'caddr' => $this->request->getPost('caddr'),
         'zipcode' => $this->request->getPost('zipcode'),
         'product' => $this->request->getPost('product'),
         'quantity' => $this->request->getPost('quantity'),
        ]);
         
        $success = $orders->save();
         if($success){
            $eventsManager->attach(
                'order',
                 new \App\Components\Listener()
                 );
     
               $component->process2();
                $this->response->redirect('../index');
         }
       
    }
   

}