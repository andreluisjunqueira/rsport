<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of verificarLogado
 *
 * @author Bob
 */
class Helpers_login {
    //put your code here

        public static function verificarLogon($view){
            $auth = Zend_Auth::getInstance();
            $dadosUser = $auth->getStorage()->read();
            $modulo = Zend_Controller_Front::getInstance()->getRequest()->getModuleName();
            $url = '';
            if(!$auth->hasIdentity()){
//                 $url = 'index/index';
                 $url = $view->baseUrl('/index');
//                 $url = $view->url(array('controller'=>'index','action'=>'index'));
            }else{
                if( ($dadosUser->FL_ADMIN_USU == 0) && ( $modulo == 'admin') ){
                    $url = $view->url( array('module'=>'aluno','controller'=>'index') );
                }else if(($dadosUser->FL_ADMIN_USU == 1) && ( $modulo == 'aluno')){
                    $url = $view->url( array('module'=>'admin','controller'=>'index') );
                }
            }
            if($url != ''){
                //die($url);
                 header('location:'.$url);
            }
    }
    public static function logout(){
        $auth = Zend_Auth::getInstance();
        $auth->clearIdentity();
    }
}
