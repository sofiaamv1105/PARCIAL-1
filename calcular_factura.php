<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura</title>
    <link rel="stylesheet" href="style.css">
</head>
</html>
<?php
require_once 'clases.php';

// Asumimos que el formulario siempre se envía correctamente
$nombreCliente = $_POST['nombre_cliente'];
$tipoCurso = $_POST['tipo_curso'];
$precioCurso = $_POST['precio_curso'];
$nombresCertificaciones = $_POST['nombre_certificacion'];
$costosCertificaciones = $_POST['costo_certificacion'];

// Creamos una instancia de Curso
$curso = new Curso($tipoCurso);

// Creamos una instancia de Factura
$factura = new Factura($nombreCliente, $curso);

// Agregamos las certificaciones a la factura
for ($i = 0; $i < count($nombresCertificaciones); $i++) {
    $factura->agregarCertificacion($nombresCertificaciones[$i], $costosCertificaciones[$i]);
}

// Realizamos los cálculos
$factura->calcularSubtotal();
$factura->calcularDescuento();
$factura->calcularIVA();
$factura->calcularTotal();

// Mostramos la factura utilizando el método mostrarFactura()
$factura->mostrarFactura();
?>
