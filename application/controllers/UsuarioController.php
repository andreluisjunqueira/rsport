<?php

class UsuarioController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $this->_helper->layout()->disableLayout(); 
        $this->_helper->viewRenderer->setNoRender(true);
        
        $model = new Application_Model_Usuarios();
        
        $data = $model->getAll();
        print_r( json_encode($data) );
        
    }
    
    public function loginAction(){
        $this->_helper->layout()->disableLayout(); 
        $this->_helper->viewRenderer->setNoRender(true);
        
        $usuario = $this->_getParam("usuario");
        $senha = $this->_getParam("senha");
        
        $logged = Application_Model_Usuarios::logar($usuario, $senha);
        
        if($logged){
            $this->getResponse()->setHttpResponseCode(200);
            print( json_encode($logged) );
        }else{
            $this->getResponse()->setHttpResponseCode(401);
        }
    }
        
    
    public function logoutAction(){
        $this->_helper->layout()->disableLayout(); 
        $this->_helper->viewRenderer->setNoRender(true);
        Helpers_login::logout();
        $this->redirect('/index');
    }
    
    public function putAction(){
        
        
        
    }


}

