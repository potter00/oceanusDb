<?php
//creamos una clase para los convenios

class Convenio {
    public $idConvenio;
    public $fechaInicio;
    public $fechaFinal;
    public $montoAdicional;
    

    public function __construct($idConvenio, $fechaInicio, $fechaFinal, $montoAdicional) {
        $this->idConvenio = $idConvenio;
        $this->fechaInicio = $fechaInicio;
        $this->fechaFinal = $fechaFinal;
        $this->montoAdicional = $montoAdicional;
    }

    
}