<?php
session_start();
$_SESSION['nombre'] = $_POST['nombre'];
$_SESSION['curso'] = $_POST['curso'];
$_SESSION['certificaciones'] = $_POST['certificaciones'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Certificaciones Adicionales</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
<div id="menuppal">
        <a href="Formulario.html">Volver</a>
    </div>
    <h1>Certificaciones Adicionales</h1>
    <form action="factura.php" method="POST">
        <p><strong>Nombre del Cliente:</strong> <?php echo $_SESSION['nombre']; ?></p>
        <p><strong>Tipo de Curso Base:</strong> <?php echo $_SESSION['curso']; ?></p>
        <p><strong>Número de Certificaciones Adicionales:</strong> <?php echo $_SESSION['certificaciones']; ?></p>

        <?php
        $numCertificaciones = $_SESSION['certificaciones'];
        for ($i = 1; $i <= $numCertificaciones; $i++) {
            echo "<h3>Certificación $i</h3>";
            echo "<label for='nombreCertificacion$i'>Nombre de la Certificación:</label>";
            echo "<input type='text' id='nombreCertificacion$i' name='nombreCertificacion$i' required><br><br>";
            echo "<label for='costoCertificacion$i'>Costo de la Certificación:</label>";
            echo "<input type='number' id='costoCertificacion$i' name='costoCertificacion$i' step='0.01' required><br><br>";
        }
        ?>

        <input type="submit" value="Calcular Factura">
    </form>
</body>
</html>