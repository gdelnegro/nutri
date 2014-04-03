<?php
class OPI_Formulario
{
    /*
     * Tipo de Formulário
     *     GRID = Grid de Resultados
     *     FORM = Formulário de Manutenção de Dados
     *     CRUD = Crud Completo
     */
    private $tipoFormulario;
    /*
     * Caption do Formulário
    */
    private $captionFormulario;
    
    
    public function setTipoFormulario( $tipoFormulario ) {
        $this->tipoFormulario = $tipoFormulario;
    }
    
    public function setCaptionFormulario( $captionFormulario ) {
    	$this->captionFormulario = $captionFormulario;
    }
     
}

?>