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
            case 'Recreativo':
                return 2500000;
            case 'Avanzado':
                return 4000000;
            case 'Nocturno':
                return 3500000;
            case 'Cuevas':
                return 6000000;
            case 'Instructor':
                return 8000000;
            default:
                return 0;
        }
    }

    public function getCostoBase() {
        return $this->costoBase;
    }

    public function getTipoCurso() {
        return $this->tipoCurso;
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

    public function mostrarFactura() {
        echo "<h2>Resumen de la Factura</h2>";
        echo "<p><strong>Nombre del Cliente:</strong> " . $this->nombreCliente . "</p>";
        echo "<p><strong>Tipo de Curso Base:</strong> " . $this->curso->getTipoCurso() . "</p>"; // Mostrar el tipo de curso
        echo "<p><strong>Costo Base:</strong> $" . number_format($this->curso->getCostoBase(), 2, ',', '.') . "</p>"; // Mostrar el costo base
        echo "<p><strong>Certificaciones Adicionales:</strong></p>";
        foreach ($this->certificaciones as $index => $certificacion) {
            echo "<p>Certificación " . ($index + 1) . ": " . $certificacion['nombre'] . " - $" . number_format($certificacion['costo'], 2, ',', '.') . "</p>";
        }
        echo "<p><strong>Subtotal:</strong> $" . number_format($this->subtotal, 2, ',', '.') . "</p>";
        echo "<p><strong>Descuento:</strong> $" . number_format($this->descuento, 2, ',', '.') . "</p>";
        echo "<p><strong>IVA (19%):</strong> $" . number_format($this->iva, 2, ',', '.') . "</p>";
        echo "<p><strong>Total a Pagar:</strong> $" . number_format($this->total, 2, ',', '.') . "</p>";
    }
}
?>