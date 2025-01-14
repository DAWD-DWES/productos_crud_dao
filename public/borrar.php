<?php
session_start();
if (!isset($_SESSION['usuario'])) {
//si no me llega el código del producto a borrar
//nos vamos a listado.php
    header('Location:index.php');
    die;
}
if (!filter_has_var(INPUT_POST, 'borrar')) {
//si no me llega el código del producto a borrar
//nos vamos a listado.php
    header('Location:listado.php');
    die;
}
require_once '../src/autoload.php';
require_once '../src/error_handler.php';

$bd = BD::getConexion();

$id = filter_input(INPUT_POST, 'id');

$productoDao = new ProductoDAO($bd);

try {
    $productoBorrado = $productoDao->elimina($id);
} catch (PDOException $ex) {
    error_log("Error al borrar el producto" . $ex->getMessage());
    $productoBorrado = false;
}

$usuario = ($_SESSION['usuario']) ?? false;
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- css para usar Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
              integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
        <title>Borrar Producto</title>
    </head>
    <body class="bg-info">
        <div class="float-end d-inline-flex m-3">
            <i class="bi-person-fill fs-2 me-3"></i>
            <input type="text" value="<?= $usuario ?>"
                   class="form-control form-control-sm me-2 bg-transparent text-white" disabled>
            <a href='index.php?logout' class='btn btn-danger me-2'>Salir</a>
        </div>
        <h3 class="text-center mt-2 fw-bold">Borrar Producto</h3>
        <div class="container mt-3">
            <h3 class="text-center mt-2 fw-bold">
                <?= ($productoBorrado) ? "Producto borrado con éxito" : "Ha habido un problema para borrar el producto" ?>
            </h3>
            <a href="index.php" class="btn btn-warning">Volver</a>
        </div>
    </body>
</html>