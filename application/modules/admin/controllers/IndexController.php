<?php

class Admin_IndexController extends Zend_Controller_Action
{

    public function init()
    {
        $usuario = Zend_Auth::getInstance()->getIdentity();
        //$this->view->usuario = $usuario;
        Zend_Layout::getMvcInstance()->assign('usuario', $usuario);
    }

    public function indexAction()
    {
        $this->_helper->layout()->disableLayout();
        
        $loginForm = new Admin_Form_Login();
        
        if( $this->getRequest()->isPost() ) {
            $data = $this->getRequest()->getPost();
            
            if ( $loginForm->isValid($data) ){
                $login = $loginForm->getValue('login');
                $pass  = $loginForm->getValue('senha');
                
                $dbAdapter = Zend_Db_Table::getDefaultAdapter();
                
                $authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);
                $authAdapter->setTableName('usuarios')
                        ->setIdentityColumn('login')
                        ->setCredentialColumn('senha')
                        ->setCredentialTreatment('MD5(?)');
                
                $authAdapter->setIdentity($login)->setCredential($pass);
                
                $auth = Zend_Auth::getInstance();
                
                $result = $auth->authenticate($authAdapter);
                
                if( $result->isValid() ) {
                    $user = $authAdapter->getResultRowObject();
                    $auth->getStorage()->write($user);
                    $this->_redirect('admin/blog');
                }
                else{
                    $this->view->erro='Dados Invalidos';
                    $this->view->loginForm = $loginForm->populate($data);
                }
            }else{
                
                $this->view->erro='Dados Invalidos';
                $this->view->loginForm = $loginForm->populate($data);
            }
        }
        $this->view->loginForm = $loginForm;
    }
    
    public function logoutAction()
    {
        $auth = Zend_Auth::getInstance();
        $auth->clearIdentity();
        $this->_redirect('admin/');
    }
   
}

