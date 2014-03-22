<?php

class Admin_SliderController extends Zend_Controller_Action
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
        $bdArtigos = new Application_Model_DbTable_Imagens();
        $imagens = $bdArtigos->pesquisarImagem(null, 'categoria = 4');
        
        $paginator = Zend_Paginator::factory($imagens);
        $paginator->setItemCountPerPage(50);
        $paginator->setPageRange(10);
        $paginator->setCurrentPageNumber($this->_request->getParam('pagina'));
        $this->view->paginator = $paginator;
    }
    
    public function newAction()
    {
        $titulo = urldecode( $this->_getParam('nome') );
        $titulo = str_replace(' ', '_',$titulo);
        
        $bdImagem = new Application_Model_DbTable_Imagens();
        
        $formSlider = new Admin_Form_Imagens();
        
        if( $this->getRequest()->isPost() ) {
            $data = $this->getRequest()->getPost();
            
            if ( $formSlider->isValid($data) ){                
        
                /*Faz upload do arquivo*/
                $upload = new Zend_File_Transfer_Adapter_Http();
                foreach ($upload->getFileInfo() as $file => $info) {                                     
                    $extension = pathinfo($info['name'], PATHINFO_EXTENSION); 
                    $upload->addFilter('Rename', array( 'target' => APPLICATION_PATH.'/../public/images/slider-'.$titulo.'.'.$extension,'overwrite' => true,));
                }
            try {
                $upload->receive();
                } catch (Zend_File_Transfer_Exception $e) {
                    echo $e->getMessage();
                }
        
                /*Adicionar dados no banco de dados*/
        
                $dados =array(
                    'descricao'  =>   $data['descricao'],
                    'nome'      =>  'slider-'.$titulo.'.'.$extension,
                    'local'     =>  './images/',
                    'categoria' => '4'
                );
        
                $bdImagem->incluirImagem($dados);        
                       
                return $this->_helper->redirector->goToRoute( array('module'=>'admin','controller' => 'slider'), null, true);
            }else{
                $this->view->erro='Dados Invalidos';
                $this->view->formSlider = $formSlider->populate($data);
            }
        }
        $this->view->formSlider = $formSlider;
    }
    
    public function deleteAction(){
        $id = $this->_getParam('id');
        
        $dbImagem = new Application_Model_DbTable_Imagens();
        $dbImagem->excluirImagem($id);

        return $this->_helper->redirector->goToRoute( array('module'=>'admin','controller' => 'slider'), null, true);
        
    }

}