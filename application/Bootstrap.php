<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{


    protected function _initAutoload(){

        $autoloader = Zend_Loader_Autoloader::getInstance();
        $autoloader->registerNamespace(array('Admin_'));
        $autoloader->setFallbackAutoloader(true);
        $autoloader->suppressNotFoundWarnings(false);
        return $autoloader;
    }
    
//    protected function _initResourceAutoloader(){
//
//        $autoloader = new Zend_Loader_Autoloader_Resource(array(
//            'basePath'=>APPLICATION_PATH,
//            'namespace'=>'Application'
//        ));
//        $autoloader->addResourceType('model','models','Model');
//        return $autoloader;
//    }
}

