<?php

class Admin_Form_Sponsor extends Twitter_Form
{

    public function init()
    {
        
        $nome = new Zend_Form_Element_Text('sponsor');
        $nome->setLabel('Nome')
                ->setRequired('true')
                ->setValidators( array(
                     array('notEmpty', true, array(
                         'messages' => array(
                             'isEmpty' => 'O nome do parceiro não pode ser nulo'
                         )
                     ))
               ));
        
        $arquivo = new Zend_Form_Element_File('arquivo');
        $arquivo->setLabel('Logotipo')
                ->setRequired('true')
                ->addValidator('Count', false, 1)
                ->addValidator('Size',false,5502400)
                ->addValidator('Extension',false,'jpg,png,gif');
        
        $this->addElements(array(
            $nome,
            $arquivo,
        ));
        
        #$this->addSubForm($formImagem, 'teste');
        
        $submit = new Zend_Form_Element_Submit('enviar');
        
        $this->addElement($submit);
    }


}

