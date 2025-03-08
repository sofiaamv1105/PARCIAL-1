<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombreCliente = $_POST['nombre_cliente'];
    $tipoCurso = $_POST['tipo_curso'];
    $numCertificaciones = $_POST['num_certificaciones'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificaciones Adicionales</title>
</head>
<body>
    <h1>Certificaciones Adicionales</h1>
    <form action="calcular_factura.php" method="post">
        <input type="hidden" name="nombre_cliente" value="<?php echo $nombreCliente; ?>">
        <input type="hidden" name="tipo_curso" value="<?php echo $tipoCurso; ?>">
        <p><strong>Nombre del Cliente:</strong> <?php echo $nombreCliente; ?></p>
        <p><strong>Tipo de Curso Base:</strong> <?php echo $tipoCurso; ?></p>
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