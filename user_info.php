<?php
require "funciones.php";

$cosas = new UsuarioCosas();
$id = $_GET["id"] ?? null;
$usuario = $cosas->obtenerPorId($id);

if (!$usuario) {
    echo "Usuario no encontrado";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Datos de <?= $usuario["nombre"] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<div class="container mt-5">

    <div class="card" style="max-width: 500px; margin: auto;">
        <div class="card-header text-center">
            <h3><?= htmlspecialchars($usuario["nombre"]) ?></h3>
        </div>

        <div class="card-body text-center">

            <?php if (!empty($usuario["avatar"])): ?>
                <img src="uploads/<?= $usuario["avatar"] ?>" class="img-thumbnail mb-3" width="150" height="150">
            <?php else: ?>
                <div class="bg-secondary text-white d-flex align-items-center justify-content-center mb-3"
                     style="width:150px; height:150px; border-radius:50%; margin:auto;">
                     Sin Avatar
                </div>
            <?php endif; ?>

            <ul class="list-group text-start">
                <li class="list-group-item"><strong>ID:</strong> <?= $usuario["id"] ?></li>
                <li class="list-group-item"><strong>Email:</strong> <?= $usuario["email"] ?></li>
                <li class="list-group-item"><strong>Rol:</strong> <?= $usuario["rol"] ?></li>
                <li class="list-group-item"><strong>Fecha Alta:</strong> <?= $usuario["fecha_alta"] ?></li>
            </ul>

        </div>

        <div class="card-footer text-center">
            <a href="user_index.php" class="btn btn-secondary">Volver</a>
            <a href="user_edit.php?id=<?= $usuario["id"] ?>" class="btn btn-warning">Editar</a>
        </div>

    </div>

</div>
</body>
</html>
