<?php
require "funciones.php";

$cosas = new UsuarioCosas();
$id = $_GET["id"] ?? null;

$usuario = $cosas->obtenerPorId($id);

if (!$usuario) {
    echo "Usuario no encontrado";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $avatar = $usuario["avatar"];

    if (!empty($_FILES["avatar"]["name"])) {
        $extension = pathinfo($_FILES["avatar"]["name"], PATHINFO_EXTENSION);
        $avatar = uniqid() . "." . $extension;
        move_uploaded_file($_FILES["avatar"]["tmp_name"], "uploads/" . $avatar);
    }

    $userObj = new Usuario([
        "id" => $id,
        "nombre" => $_POST["nombre"],
        "email" => $_POST["email"],
        "rol" => $_POST["rol"],
        "fecha_alta" => $_POST["fecha_alta"],
        "avatar" => $avatar
    ]);

    $cosas->actualizar($userObj);

    header("Location: user_index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<div class="container mt-5">
    <h2>Editar Usuario: <?= htmlspecialchars($usuario["nombre"]) ?></h2>

    <form method="post" enctype="multipart/form-data" class="mt-3">

        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="nombre" value="<?= $usuario["nombre"] ?>" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" value="<?= $usuario["email"] ?>" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Rol</label>
            <select name="rol" class="form-select">
                <option value="Usuario" <?= $usuario["rol"]=="Usuario"?"selected":"" ?>>Usuario</option>
                <option value="Administrador" <?= $usuario["rol"]=="Administrador"?"selected":"" ?>>Administrador</option>
                <option value="Moderador" <?= $usuario["rol"]=="Moderador"?"selected":"" ?>>Moderador</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Fecha Alta</label>
            <input type="date" name="fecha_alta" value="<?= $usuario["fecha_alta"] ?>" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Avatar</label>
            <input type="file" name="avatar" class="form-control" accept="image/*">
            <?php if ($usuario["avatar"]): ?>
                <img src="uploads/<?= $usuario["avatar"] ?>" width="100" class="img-thumbnail mt-2">
            <?php endif; ?>
        </div>

        <button class="btn btn-success">Guardar cambios</button>
        <a href="user_index.php" class="btn btn-secondary">Volver</a>

    </form>
</div>
</body>
</html>
