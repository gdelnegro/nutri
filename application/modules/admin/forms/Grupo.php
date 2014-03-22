<?php

class Admin_Form_Grupo extends Twitter_Form
{
    
    protected $exibir;
    protected $tipo;
    protected $usr;

    public function __construct($tipo = null, $usr = null, $options = null) {
        $this->tipo = strtoupper($tipo);
        $this->usr = $usr;
        
        if ( strtoupper($tipo)=='EDIT' OR strtoupper($tipo)=='NEW'){
            $this->exibir = null;
        }else if ( strtoupper($tipo) == 'SHOW' ){
            $this->exibir = true;
        }
        parent::__construct($options);
    }

    public function init()
    {
        
        $this->setMethod('post');
        $this->setAttrib('horizontal', true);
        /* Form Elements & Other Definitions Here ... */
        $descricao = new Zend_Form_Element_Text('descricao');
        $descricao->setLabel('Nome do Grupo')
                ->setRequired('true')
                ->setAttrib('autocomplete', 'off')
                ->setAttrib('disabled', $this->exibir)
                ->setValidators( array(
                     array('notEmpty', true, array(
                         'messages' => array(
                             'isEmpty' => 'O nome do grupo não pode ser nulo'
                         )
                     ))
               ));
        
        $id = new Zend_Form_Element_Hidden('idGrupo');
        
        $submit = new Zend_Form_Element_Submit('Enviar');
        
        $this->addElements( array(
            $id,
            $descricao,
            
        ));
        
        if ( $this->tipo != 'SHOW' ){
            $this->addElement($submit);
        }
    }


}

