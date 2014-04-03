<?php

class Admin_RevistasController extends Zend_Controller_Action
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
        $dbRevistas = new Application_Model_DbTable_Revistas();
        $dados = $dbRevistas->pesquisarRevista();
        
        $paginator = Zend_Paginator::factory($dados);
        $paginator->setItemCountPerPage(50);
        $paginator->setPageRange(10);
        $paginator->setCurrentPageNumber($this->_request->getParam('pagina'));
        $this->view->paginator = $paginator;
    }
    
    public function newAction()
    {
        $titulo = urldecode( $this->_getParam('titulo') );
        $titulo = str_replace(' ', '_',$titulo);
        
        $bdImagem = new Application_Model_DbTable_Imagens();
        $dbRevista = new Application_Model_DbTable_Revistas();
        
        $formRevista = new Admin_Form_Revistas();
        
        if( $this->getRequest()->isPost() ) {
            $data = $this->getRequest()->getPost();
            
            if ( $formRevista->isValid($data) ){                
                $dbImagens = new Application_Model_DbTable_Imagens();
        
                /*Faz upload do arquivo*/
                $upload = new Zend_File_Transfer_Adapter_Http();
                foreach ($upload->getFileInfo() as $file => $info) {                                     
                    $extension = pathinfo($info['name'], PATHINFO_EXTENSION); 
                    $upload->addFilter('Rename', array( 'target' => APPLICATION_PATH.'/../public/images/capa-'.$titulo.'.'.$extension,'overwrite' => true,));
                }
            try {
                $upload->receive();
                } catch (Zend_File_Transfer_Exception $e) {
                    echo $e->getMessage();
                }
        
                /*Adicionar dados no banco de dados*/
        
                $dados =array(
                    'descricao'  =>   'Logotipo'.$this->_getParam('sponsor'),
                    'nome'      =>  'revista-'.$titulo.'.'.$extension,
                    'local'     =>  '../public/images/',
                    'categoria' => '5'
                );
        
                $idImagem = $bdImagem->incluirImagem($dados);        
                       
                $dbRevista->incluirRevista($data, $idImagem);
                return $this->_helper->redirector->goToRoute( array('module'=>'admin','controller' => 'article'), null, true);
                #$this->view->dados = $data;
                
            }else{
                $this->view->erro='Dados Invalidos';
                $this->view->formMateria = $formRevista->populate($data);
            }
        }
        $this->view->formMateria = $formRevista;
    }


}

