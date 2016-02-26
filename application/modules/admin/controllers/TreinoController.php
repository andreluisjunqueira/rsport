<?php
class Admin_TreinoController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $api = $this->getParam('api');
        $modelTreinos = new Application_Model_Treinos();
        $treinos = $modelTreinos->getTreinos();
        if($api){
            $this->_helper->layout()->disableLayout(); 
            $this->_helper->viewRenderer->setNoRender(true);
            print_r(json_encode($treinos));
            exit();
        }
        
        $this->view->data = $treinos;
    }
    
    public function idAction(){
        $id = $this->getParam('q');
        $modelTreinos = new Application_Model_Treinos();
        $treino = $modelTreinos->getTreino($id);
        $this->view->treino = $treino;

    }
    
    public function putAction(){
        
        $params = $this->_request->getParams();
        $modelTreinos = new Application_Model_Treinos();
        $db = $modelTreinos->getDefaultAdapter();
        try {
            $db->beginTransaction();
            $row = $modelTreinos->createRow();
            $row->ST_IDENTIFICADOR_TRE = $params['idTreino'];
            $row->ID_OBJETIVO_TRE = $params['objetivo'];
            $row->ST_DESCRICAO_TRE = $params['descricao'];
            $row->save();
            $db->commit();
            print_r(true);
            exit();
        } catch (Exception $ex) {
            $db->rollBack();
            print_r(true);
            exit();
        }
    }
    
    public function deleteAction(){
        
        $this->_helper->layout()->disableLayout(); 
        $this->_helper->viewRenderer->setNoRender(true);
        $id = $this->getParam('id');
        $modelTreino = new Application_Model_Treinos();
        try {
            $modelTreino->delete("ID_TREINO_TRE = $id");
            print(true);
            exit(0);
        } catch (Exception $ex) {
            print($ex);
            exit(0);
        }
    }

     public function objetivoputAction(){
        $this->_helper->layout()->disableLayout(); 
        $this->_helper->viewRenderer->setNoRender(true);
        $modelObjetivo = new Application_Model_Objetivos();
        $db = $modelObjetivo->getDefaultAdapter();
        $params = $this->getAllParams();
        $objetivo = $params['objetivo'];
        try {
            $db->beginTransaction();
            $row = $modelObjetivo->createRow();
            $row->ST_NOME_OBJ = $objetivo;
            $row->save();
            $db->commit();
            print_r(true);
            exit();
        } catch (Exception $ex) {
            $db->rollBack();
            return(false);
            exit();
        }
     }
     public function getobjetivosAction(){
        $this->_helper->layout()->disableLayout(); 
        $this->_helper->viewRenderer->setNoRender(true);
        $modelObjetivo = new Application_Model_Objetivos();
        
        $objetivos = $modelObjetivo->getObjetivos();
        
        print_r(json_encode($objetivos));
        exit();
     }
}

