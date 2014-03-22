<?php

class Admin_LogoController extends Zend_Controller_Action
{

    public function init()
    {
        $usuario = Zend_Auth::getInstance()->getIdentity();
        Zend_Layout::getMvcInstance()->assign('usuario', $usuario);
        
        if ( !Zend_Auth::getInstance()->hasIdentity() ) {
                return $this->_helper->redirector->goToRoute( array('module'=>'admin','controller' => 'index'), null, true);
        }
    }

    public function indexAction()
    {
        $bdLogo = new Application_Model_DbTable_Logo();
        $logo = $bdLogo->pesquisarLogo();
        
        $paginator = Zend_Paginator::factory($logo);
        $paginator->setItemCountPerPage(50);
        $paginator->setPageRange(10);
        $paginator->setCurrentPageNumber($this->_request->getParam('pagina'));
        $this->view->paginator = $paginator;
    }
    
    public function editAction()
    {

        $formLogo = new Admin_Form_Logo();
        
        if( $this->getRequest()->isPost() ) {
            $data = $this->getRequest()->getPost();
            
            if ( $formLogo->isValid($data) ){                
                $dbLogo = new Application_Model_DbTable_Logo();
                $dbLogo->alterarLogo($data['cor']);
                return $this->_helper->redirector->goToRoute( array('module'=>'admin','controller' => 'logo'), null, true);
                #$this->view->dados = $data;
                
            }else{
                $this->view->erro='Dados Invalidos';
                $this->view->formLogo = $formLogo->populate($data);
            }
        }
        $this->view->formLogo = $formLogo;
        
    }


}

