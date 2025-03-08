<?php
class Curso {
    private $tipoCurso;
    private $costoBase;

    public function __construct($tipoCurso) {
        $this->tipoCurso = $tipoCurso;
        $this->costoBase = $this->calcularCostoBase();
    }

    private function calcularCostoBase() {
        switch ($this->tipoCurso) {
            case '2500000':
                return 2500000;
            case '4000000':
                return 4000000;
            case '3500000':
                return 3500000;
            case '6000000':
                return 6000000;
            case '8000000':
                return 8000000;
            default:
                return 0;
        }
    }

    public function getTipoCurso() {
        return $this->tipoCurso;
    }

    public function getCostoBase() {
        return $this->costoBase;
    }
}

class Factura {
    private $nombreCliente;
    private $curso;
    private $certificaciones = [];
    private $subtotal = 0;
    private $descuento = 0;
    private $iva = 0;
    private $total = 0;

    public function __construct($nombreCliente, $curso) {
        $this->nombreCliente = $nombreCliente;
        $this->curso = $curso;
    }

    public function agregarCertificacion($nombre, $costo) {
        $this->certificaciones[] = ['nombre' => $nombre, 'costo' => $costo];
    }

    public function calcularSubtotal() {
        $this->subtotal = $this->curso->getCostoBase();
        foreach ($this->certificaciones as $certificacion) {
            $this->subtotal += $certificacion['costo'];
        }
    }

    public function calcularDescuento() {
        $numCertificaciones = count($this->certificaciones);
        if ($numCertificaciones >= 3 && $numCertificaciones <= 5) {
            $this->descuento = $this->subtotal * 0.05;
        } elseif ($numCertificaciones >= 6 && $numCertificaciones <= 8) {
            $this->descuento = $this->subtotal * 0.10;
        } elseif ($numCertificaciones > 8) {
            $this->descuento = $this->subtotal * 0.15;
        }
    }

    public function calcularIVA() {
        $this->iva = ($this->subtotal - $this->descuento) * 0.19;
    }

    public function calcularTotal() {
        $this->total = ($this->subtotal - $this->descuento) + $this->iva;
    }

    public function getCertificaciones() {
        return $this->certificaciones;
    }

    public function getSubtotal() {
        return $this->subtotal;
    }

    public function getDescuento() {
        return $this->descuento;
    }

    public function getIVA() {
        return $this->iva;
    }

    public function getTotal() {
        return $this->total;
    }
}
?>