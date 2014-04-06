<?php

class Default_BlogController extends Zend_Controller_Action
{

    public function init()
    {
        
    }

    public function indexAction()
    {
        $dbNoticias = new Admin_Model_DbTable_Artigo();
        $noticias = $dbNoticias->pesquisarArtigo(null);        
        $this->view->materias = $noticias;
    }
    
    public function showAction(){
        $id = $this->_getParam('id');
        $dbNoticias = new Admin_Model_DbTable_Artigo();
        $noticias = $dbNoticias->pesquisarArtigo($id);        
        $this->view->materias = $noticias;
    }

}
