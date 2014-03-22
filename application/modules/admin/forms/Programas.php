<?php

class Admin_Form_Programas extends Twitter_Form
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
        /* Form Elements & Other Definitions Here ... */
        $this->setMethod('post');
        $this->setAttrib('horizontal', true);
        
        /*Elementos*/
        
        /*Hidden*/
        
        $idPrograma = new Zend_Form_Element_Hidden('idPrograma');
        
        /*Titulo do video*/
        $titulo = new Zend_Form_Element_Text('titulo');
        $titulo->setLabel('Titulo do Video')
                ->setRequired('true')
                ->setFilters(array('StringTrim'))
                ->setValidators(array(
                    array('notEmpty', true, array(
                        'messages' => array(
                            'isEmpty' => "O titulo não pode ser nulo"
                        )
                    )),
                ))
                ->setAttrib('disabled', $this->exibir);
        
        /*Resumo do video*/
        $descricao = new Zend_Form_Element_Textarea('descricao');
        $descricao->setLabel('Descrição do Vídeo')
                ->setRequired('true')
                ->setFilters(array('StringTrim'))
                ->setValidators(array(
                    array('notEmpty', true, array(
                        'messages' => array(
                            'isEmpty' => "A descrição não pode ser nula"
                        )
                    )),
                ))
                ->setAttrib('rows', 10)
                ->setAttrib('disabled', $this->exibir);
        
        /*Url do vídeo*/
        $url = new Zend_Form_Element_Text('url');
        $url->setLabel('Url do vídeo')
                ->setRequired('true')
                ->setFilters(array('StringTrim'))
                ->setValidators(array(
                    array('notEmpty', true, array(
                        'messages' => array(
                            'isEmpty' => "A URL não pode ser nula"
                        )
                    )),
                ))
                ->setAttrib('disabled', $this->exibir);
        
        $status = new Zend_Form_Element_Select('status');
        
        $dtInclusao = new Zend_Form_Element_Text('dtInclusao');
        $dtAlteracao = new Zend_Form_Element_Text('dtAlteracao');
        
        $submit = new Zend_Form_Element_Submit('enviar');
        $submit->setAttrib(
        'onclick', 
        'if (confirm("Deseja prosseguir?")) { document.form.submit(); } return false;'
        )
                ->setAttrib('class','btn-primary');
        
        $this->addElements(array(
            $idPrograma,
            $titulo,
            $descricao,
            $url
        ));
        
        if ($this->tipo != 'SHOW') {
            
            $this->addElement($submit);
        }
        
        if ($this->tipo == 'SHOW') {
            /*Botão Imprimir*/
        $this->addElement("button", "imprimir", array(
                        "class" => "btn-primary",
                        "label" => "Imprimir",
                        "onclick" => 'window.print()',
                        //"onclick" => 'window.location =\''.$this->getView()->url(array('controller'=>'papel','action'=>'print')).'\' '
                ));
        }
        
        /*Botão Voltar*/
        $this->addElement("button", "voltar", array(
                        "class" => "btn-primary",
                        "label" => "Voltar",
                        "onclick" => 'window.location =\''.$this->getView()->url(array('controller'=>'programas','action'=>'index')).'\' '
                        
                ));
        
    }

}

