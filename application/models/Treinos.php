<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Treinos
 *
 * @author Bob
 */
class Application_Model_Treinos extends Zend_Db_Table_Abstract {
    
    protected $_name = 'treinos';

    public function getTreinos($id = ''){
        
        
        $treinos = $this->select()
                ->from($this->_name)
                ->setIntegrityCheck(false)
                ->joinLeft(array('objetivo'),'ID_OBJETIVO_TRE = ID_OBJETIVO_OBJ ' )
                ->query()
                ->fetchAll();
        return $treinos;
    }
    public function getTreino($id){
        if(!$id) throw new Exception ('O id não pode ser vazio'); 
            $treino = $this->select()
                ->from($this->_name)
                ->setIntegrityCheck(false)
                ->joinLeft(array('objetivo'),'ID_OBJETIVO_TRE = ID_OBJETIVO_OBJ ' )
                ->where('ID_TREINO_TRE = ?',$id)
                ->query()
                ->fetchAll();
        return $treino;
    }
}
