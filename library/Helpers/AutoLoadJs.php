<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AutoLoadJs
 *
 * @author Bob
 */
class Helpers_AutoLoadJs {

    
    public static function carregarJs($path){
        
        
        $nomeJs = array_shift( explode('.', array_pop(explode('\\',$path))) );
        
        $caminho = substr($path, 0, strripos($path, '\\'));
        $caminho = implode('/', explode('\\', $caminho));
        
        $diretorio = dir($caminho);
        while($arquivo = $diretorio->read()){
            echo $arquivo;
        }
        //$modulo = Zend_Controller_Front::getInstance()->getRequest()->getModuleName();
        print_r($caminho);
        
        
    }
    
}
