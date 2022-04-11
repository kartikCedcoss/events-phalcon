<?php
declare(strict_types=1);

use Phalcon\Mvc\Controller;
use Phalcon\Events\Manager as EventsManager;


class AddproductController extends Controller
{
    public function indexAction()
    {
    
    }
    public function addAction(){
        $products= new Products();
        $eventsManager = new EventsManager();
        $component = new \App\Handler\Aware();
        $component->setEventsManager($eventsManager);

           $products->assign([
            'name'=> $this->request->getPost('name'),
            'description'=>$this->request->getPost('description'),
            'tags'=> $this->request->getPost('tags'),
            'price'=> $this->request->getPost('price'),
            'stock'=>$this->request->getPost('stock'),

        ]);
        $success = $products->save();

        if($success){
           $eventsManager->attach(
           'product',
            new \App\Handler\Listener()
            );

          $component->process1();
          $this->response->redirect('../index');
        }
         


    }

   

}