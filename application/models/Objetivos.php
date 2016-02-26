<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Objetivos
 *
 * @author Bob
 */
class Application_Model_Objetivos extends Zend_Db_Table_Abstract{
    //put your code here
    
    protected $_name = "objetivo";
    
    public function getObjetivos(){
        $resul = $this->select()
                        ->order('ST_NOME_OBJ ASC')
                        ->query()
                        ->fetchAll();
        return $resul;
    }

}
