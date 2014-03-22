<?php

class Admin_UsersController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        $usuario = Zend_Auth::getInstance()->getIdentity();
        //$this->view->usuario = $usuario;
        Zend_Layout::getMvcInstance()->assign('usuario', $usuario);
        
        if ( !Zend_Auth::getInstance()->hasIdentity() ) {
                return $this->_helper->redirector->goToRoute( array('module'=>'admin','controller' => 'index'), null, true);
            //$this->_redirect('/');
        }
    }

    public function indexAction()
    {
        $dbUsuario = new Admin_Model_DbTable_Usuario();
        $dadosUsuarios = $dbUsuario->pesquisarUsuario();
        $paginator = Zend_Paginator::factory($dadosUsuarios);
        
        $paginator->setItemCountPerPage(50);
        $paginator->setPageRange(10);
        $paginator->setCurrentPageNumber($this->_request->getParam('pagina'));
        $this->view->paginator = $paginator;
    }
    
    public function newAction()
    {
        $formUsuario = new Admin_Form_Usuario('new');
        $this->view->formUsuario = $formUsuario;
        
    }
    
    public function createAction()
    {
        $dados = $this->getAllParams();
        
        $auth = Zend_Auth::getInstance();
        $user = $auth->getIdentity();
        $usr = $this->view->escape(ucfirst($user->idUsuario));
        
        $dbUsuarios = new Admin_Model_DbTable_Usuario();
        #$this->view->dados = $dbUsuarios->incluirUsuario($dados, $usr);
        #
        #return $this->_helper->redirector->goToRoute( array('module'=>'admin','controller' => 'users'), null, true);
        
        $result = $dbUsuarios->incluirUsuario($dados, $usr);
        
        if ( $result == 'ok' ){
            return $this->_helper->redirector->goToRoute( array('module'=>'admin','controller' => 'users'), null, true);
        }else {
            $this->view->dados = $result;
        }
    }
    
    public function editAction()
    {
        $dbUsuarios = new Admin_Model_DbTable_Usuario();
        $dadosUsuario = $dbUsuarios->pesquisarUsuario($this->_getParam('id'));
        
        $formUsuario = new Admin_Form_Usuario('edit');
        $formUsuario->populate($dadosUsuario);
        
        $this->view->formUsuario = $formUsuario;
    }


}

