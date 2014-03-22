<?php

class Admin_Form_Imagens extends Twitter_Form
{

    public function init()
    {
        $this->setEnctype( Zend_form::ENCTYPE_MULTIPART );
        
        $arquivo = new Zend_Form_Element_File('arquivo');
        $arquivo->setLabel('Logotipo')
                ->setRequired('true')
                ->addValidator('Count', false, 1)
                ->addValidator('Size',false,5502400)
                ->addValidator('Extension',false,'jpg,png,gif');
        
        $descricao = new Zend_Form_Element_Textarea('descricao');
        $descricao->setLabel('Descrição da Imagem')
                ->setRequired('true')
                ->setValidators( array(
                     array('notEmpty', true, array(
                         'messages' => array(
                             'isEmpty' => 'A descrição não pode ser nula'
                         )
                     ))
               ));
        
        $nome = new Zend_Form_Element_Text('nome');
        $nome->setLabel('Título da Imagem')
                ->setRequired('true')
                ->setValidators( array(
                     array('notEmpty', true, array(
                         'messages' => array(
                             'isEmpty' => 'O nome da imagem não pode ser nulo'
                         )
                     ))
               ));
        
        
        $enviar = new Zend_Form_Element_Submit('enviar');
        $enviar->setLabel('Enviar');
        
        $this->addElements(array(
            $nome,
            $descricao,
            $arquivo,
            $enviar
        ));
    }


}