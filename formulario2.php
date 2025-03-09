<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombreCliente = $_POST['nombre'];
    $tipoCurso = $_POST['curso'];
    $precioCurso = $_POST['precio'];
    $numCertificaciones = $_POST['certificaciones'];

    // Validar que el número de certificaciones no sea mayor a 10
    if ($numCertificaciones > 10) {
        die("Error: El número de certificaciones no puede ser mayor a 10.");
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificaciones Adicionales</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Certificaciones Adicionales</h1>
    <form action="calcular_factura.php" method="post">
        <input type="hidden" name="nombre_cliente" value="<?php echo $nombreCliente; ?>">
        <input type="hidden" name="tipo_curso" value="<?php echo $tipoCurso; ?>">
        <input type="hidden" name="precio_curso" value="<?php echo str_replace(['$', ','], '', $precioCurso); ?>">
        <input type="hidden" name="num_certificaciones" value="<?php echo $numCertificaciones; ?>">
        <p><strong>Nombre del Cliente:</strong> <?php echo $nombreCliente; ?></p>
        <p><strong>Tipo de Curso Base:</strong> <?php echo $tipoCurso; ?></p>
        <p><strong>Precio del Curso:</strong> <?php echo $precioCurso; ?></p>
        <p><strong>Número de Certificaciones:</strong> <?php echo $numCertificaciones; ?></p>
        <?php
        for ($i = 1; $i <= $numCertificaciones; $i++) {
            echo "<div>";
            echo "<label>Nombre de la Certificación $i:</label>";
            echo "<input type='text' name='nombre_certificacion[]' required>";
            echo "<label>Costo de la Certificación $i:</label>";
            echo "<input type='number' name='costo_certificacion[]' step='0.01' required>";
            echo "</div>";
        }
        ?>
        <input type="submit" value="Calcular Factura">
    </form>
</body>
</html>
<?php
}
?>
