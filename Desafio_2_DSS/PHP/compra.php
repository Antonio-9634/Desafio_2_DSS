<?php
function validarDUI($dui) {
    return preg_match("/^[0-9]{8}-[0-9]{1}$/", $dui);
}

function validarTarjeta($tarjeta) {
    return preg_match("/^[0-9]{16}$/", $tarjeta);
}

function validarFecha($fecha) {
    return preg_match("/^(0[1-9]|1[0-2])\/(20[2-9]{2})$/", $fecha);
}

function validarCorreo($correo) {
    return filter_var($correo, FILTER_VALIDATE_EMAIL);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $dui = $_POST['dui'];
    $tarjeta = $_POST['tarjeta'];
    $fecha = $_POST['fecha'];
    $correo = $_POST['correo'];

    if (!validarDUI($dui)) {
        echo "DUI inválido.\n";
    } elseif (!validarTarjeta($tarjeta)) {
        echo "Número de tarjeta inválido.\n";
    } elseif (!validarFecha($fecha)) {
        echo "Fecha de vencimiento inválida.\n";
    } elseif (!validarCorreo($correo)) {
        echo "Correo inválido.\n";
    } else {
        echo "Compra realizada con éxito.\n";
    }
}
?>
