<?php

class Admin_SponsorController extends Zend_Controller_Action
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
        $bdImagens = new Admin_Model_DbTable_Sponsor('sponsor');
        $dadosImagens = $bdImagens->pesquisarSponsor();
        
        $paginator = Zend_Paginator::factory($dadosImagens);
        $paginator->setItemCountPerPage(50);
        $paginator->setPageRange(10);
        $paginator->setCurrentPageNumber($this->_request->getParam('pagina'));
        $this->view->paginator = $paginator;
        $this->view->dados = $dadosImagens;
    }
    
    
    public function testeAction()
    {
        $this->view->dados = $this->getAllParams();
    }
    
    public function uploadAction()
    {
        $titulo = urldecode( $this->_getParam('sponsor') );
        $titulo = str_replace(' ', '_',$titulo);
        $dbImagens = new Application_Model_DbTable_Imagens();
        
        /*Faz upload do arquivo*/
        $upload = new Zend_File_Transfer_Adapter_Http();
        
        foreach ($upload->getFileInfo() as $file => $info) {                                     
            $extension = pathinfo($info['name'], PATHINFO_EXTENSION); 
            $upload->addFilter('Rename', array( 'target' => APPLICATION_PATH.'/../public/images/sponsor-'.$titulo.'.'.$extension,'overwrite' => true,));
        }
        
        try {
            // This takes care of the moving and making sure the file is there
            $upload->receive();
            // Dump out all the file info
            } catch (Zend_File_Transfer_Exception $e) {
                echo $e->message();
            }
        
        /*Adicionar dados no banco de dados*/
        
        $dados =array(
          'descricao'  =>   'Logotipo'.$this->_getParam('sponsor'),
            'nome'      =>  'sponsor-'.$titulo.'.'.$extension,
            'local'     =>  '../public/images/',
        );
        
        $idImagem = $dbImagens->incluirImagem($dados);        
        
        $dadosSponsor = $this->getAllParams();
        $dbSponsor = new Admin_Model_DbTable_Sponsor('patrocinador');
        $dbSponsor->incluirSponsor($dadosSponsor, $idImagem);
        #$this->view->dados = $extension;
        return $this->_helper->redirector->goToRoute( array('module'=>'admin','controller' => 'sponsor'), null, true);
    }
    
    public function newAction()
    {
        #$formImagem = new Admin_Form_Imagens();
        $formImagem = new Admin_Form_Sponsor();
        $this->view->formImagem = $formImagem;
    }

}