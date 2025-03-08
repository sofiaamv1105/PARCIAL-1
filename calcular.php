<?php
class Curso {
    private $tipoCurso;
    private $costoBase;

    public function __construct($tipoCurso) {
        $this->tipoCurso = $tipoCurso;
        $this->calcularCostoBase();
    }

    private function calcularCostoBase() {
        switch ($this->tipoCurso) {
            case 'Recreativo':
                $this->costoBase = 2500000;
                break;
            case 'Avanzado':
                $this->costoBase = 4000000;
                break;
            case 'Nocturno':
                $this->costoBase = 3500000;
                break;
            case 'Cuevas':
                $this->costoBase = 6000000;
                break;
            case 'Instructor':
                $this->costoBase = 8000000;
                break;
            default:
                $this->costoBase = 0;
                break;
        }
    }

    public function getCostoBase() {
        return $this->costoBase;
    }
}

class Factura {
    private $cliente;
    private $curso;
    private $certificaciones;
    private $descuento;
    private $iva;
    private $total;

    public function __construct($cliente, $curso, $certificaciones) {
        $this->cliente = $cliente;
        $this->curso = $curso;
        $this->certificaciones = $certificaciones;
        $this->calcularTotal();
    }

    private function calcularTotal() {
        $costoBase = $this->curso->getCostoBase();
        $costoCertificaciones = array_sum($this->certificaciones);
        $subtotal = $costoBase + $costoCertificaciones;

        // Calcular descuento
        $numCertificaciones = count($this->certificaciones);
        if ($numCertificaciones >= 3 && $numCertificaciones <= 5) {
            $this->descuento = $subtotal * 0.05;
        } elseif ($numCertificaciones >= 6 && $numCertificaciones <= 8) {
            $this->descuento = $subtotal * 0.10;
        } elseif ($numCertificaciones > 8) {
            $this->descuento = $subtotal * 0.15;
        } else {
            $this->descuento = 0;
        }

        // Calcular IVA
        $this->iva = ($subtotal - $this->descuento) * 0.19;

        // Calcular total
        $this->total = $subtotal - $this->descuento + $this->iva;
    }

    public function mostrarFactura() {
        echo "<h2>Resumen de la Factura</h2>";
        echo "<p><strong>Nombre del Cliente:</strong> " . $this->cliente . "</p>";
        echo "<p><strong>Tipo de Curso Base:</strong> " . $this->curso->getCostoBase() . "</p>";
        echo "<p><strong>Costo Base:</strong> $" . number_format($this->curso->getCostoBase(), 2) . "</p>";
        echo "<p><strong>Certificaciones Adicionales:</strong></p>";
        foreach ($this->certificaciones as $index => $costo) {
            echo "<p>Certificación " . ($index + 1) . ": $" . number_format($costo, 2) . "</p>";
        }
        echo "<p><strong>Descuento:</strong> $" . number_format($this->descuento, 2) . "</p>";
        echo "<p><strong>IVA (19%):</strong> $" . number_format($this->iva, 2) . "</p>";
        echo "<p><strong>Total a Pagar:</strong> $" . number_format($this->total, 2) . "</p>";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombreCliente = $_POST['nombre_cliente'];
    $tipoCurso = $_POST['tipo_curso'];
    $nombresCertificaciones = $_POST['nombre_certificacion'];
    $costosCertificaciones = $_POST['costo_certificacion'];

    $curso = new Curso($tipoCurso);
    $factura = new Factura($nombreCliente, $curso, $costosCertificaciones);
    $factura->mostrarFactura();
}



?>