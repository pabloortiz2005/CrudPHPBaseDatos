<?php
require "funciones.php";

$cosas = new UsuarioCosas();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Avatar
    $avatarNombre = null;
    if (!empty($_FILES["avatar"]["name"])) {
        $extension = pathinfo($_FILES["avatar"]["name"], PATHINFO_EXTENSION);
        $avatarNombre = uniqid() . "." . $extension;
        move_uploaded_file($_FILES["avatar"]["tmp_name"], "uploads/" . $avatarNombre);
    }

    $usuario = new Usuario([
        "nombre" => $_POST["nombre"],
        "email" => $_POST["email"],
        "rol" => $_POST["rol"],
        "fecha_alta" => $_POST["fecha_alta"],
        "avatar" => $avatarNombre
    ]);

    $cosas->crear($usuario);

    header("Location: user_index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Crear Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Crear Nuevo Usuario</h2>
    <form method="post" enctype="multipart/form-data" class="mt-3">
        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Rol</label>
            <select name="rol" class="form-select" required>
                <option value="Usuario">Usuario</option>
                <option value="Administrador">Administrador</option>
                <option value="Moderador">Moderador</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Fecha Alta</label>
            <input type="date" name="fecha_alta" value="<?= date('Y-m-d') ?>" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Avatar</label>
            <input type="file" name="avatar" class="form-control" accept="image/*">
        </div>
        <button class="btn btn-success" type="submit">Guardar</button>
        <a href="user_index.php" class="btn btn-secondary">Volver</a>
    </form>
</div>

</body>
</html>
