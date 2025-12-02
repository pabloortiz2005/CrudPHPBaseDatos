<?php
require "funciones.php";

$cosas = new UsuarioCosas();
$usuarios = $repo->obtenerTodos();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<div class="container mt-5">

    <h2>Usuarios</h2>
    <a href="user_create.php" class="btn btn-primary mb-3">Nuevo Usuario</a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Avatar</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Fecha Alta</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>

        <?php foreach ($usuarios as $u): ?>
            <tr>
                <td><?= $u["id"] ?></td>
                <td>
                    <?php if (!empty($u["avatar"])): ?>
                        <img src="uploads/<?= $u["avatar"] ?>" width="50" class="rounded-circle">
                    <?php endif; ?>
                </td>
                <td><?= htmlspecialchars($u["nombre"]) ?></td>
                <td><?= htmlspecialchars($u["email"]) ?></td>
                <td><?= htmlspecialchars($u["rol"]) ?></td>
                <td><?= htmlspecialchars($u["fecha_alta"]) ?></td>
                <td>
                    <a href="user_info.php?id=<?= $u["id"] ?>" class="btn btn-info btn-sm">Ver</a>
                    <a href="user_edit.php?id=<?= $u["id"] ?>" class="btn btn-warning btn-sm">Editar</a>
                    <a onclick="return confirm('¿Eliminar?')" href="user_delete.php?id=<?= $u["id"] ?>" class="btn btn-danger btn-sm">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>

        </tbody>
    </table>

</div>
</body>
</html>
