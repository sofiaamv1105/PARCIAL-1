<?php
class Curso {
    private $tipoCurso;
    private $costoBase;

    public function __construct($tipoCurso) {
        $this->tipoCurso = $tipoCurso;
        $this->calcularCostoBase();
    }





?>