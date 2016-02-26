<?php

class Application_Model_Usuarios extends Zend_Db_Table_Abstract
{

    protected $_name = 'usuarios';
    //protected $_primary = 'ID_IDUSUARIOS_USU';
    

    public static function logar($usuario,$senha){
        // criação de bloco Try catch para capturar excessoes
        try{
                //cria uma instancia do adaptador default do BD
            $db = Zend_Db_Table::getDefaultAdapter();
            //cria uma instancia do zend Adapter Auth
            $Zadapter = new Zend_Auth_Adapter_DbTable($db);
            //seta a tabela de autenticação
            $Zadapter->setTableName('usuarios')
                    //seta a coluna com o nome de usuario
                     ->setIdentityColumn('ST_USUARIO_USU')
                    //seta a coluna com o campo de senha
                     ->setCredentialColumn('ST_SENHA_USU');
        }  catch (Exception $e){$e->getMessage();}
        //seta a variavel que contem o nome de usuario
            $Zadapter->setIdentity($usuario)
                    //seta a variavel que contem a senha
                     ->setCredential($senha);
            // cria uma instancia do zend auth
            $auth = Zend_Auth::getInstance();
            // invoca o metodo autenticar do zend auth, e guarda o retorno na variavel resul.
            $result = $auth->authenticate($Zadapter);

            // verifica se foi autenticado ou nao.
            if ($result->isValid())
            {    
                // escolhos os dados do usuario que quero obter da tabela de usuarios
                $dadosUsuario = $Zadapter->getResultRowObject(array('ST_NOME_USU','FL_ADMIN_USU',''));
                //cria uma variavel de sessão do "Zend_Auth" e salva os dados do usuario na sessão
                $auth->getStorage()->write($dadosUsuario);
                return $dadosUsuario;
            }else{
                self::getMessages($result);
                return false;
            }

    }
    // funcao que traduz os erros para portugues.
    public static function getMessages(Zend_Auth_Result $result){
         
        switch($result->getCode()){
             
            case $result::FAILURE_IDENTITY_NOT_FOUND :
            $msg = 'Login não encontrado';
            break;
         case $result::FAILURE_IDENTITY_AMBIGUOUS :
            $msg = 'Login em duplicidade';
            break;
         case $result::FAILURE_CREDENTIAL_INVALID:
            $msg = 'Login não encontrado';
            break;
        case $result::FAILURE_UNCATEGORIZED:
            $msg = 'Login e/ou senha nao encontados';
            break;
        default :
            $msg = 'Erro ao efetuar o login';
         
        }
        return $msg;   
    }
    

}

