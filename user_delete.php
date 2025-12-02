<?php
require "funciones.php";

$id = $_GET["id"] ?? null;

if ($id) {
    $cosas = new UsuarioCosas();
    $cosas->eliminar($id);
}

header("Location: user_index.php");
exit;
