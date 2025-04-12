<?php
session_start();
include("conexion.php");

function agregarAlCarrito($id_producto, $cantidad) {
    global $conexion;
    $producto = $conexion->query("SELECT * FROM productos WHERE id_producto = $id_producto")->fetch_assoc();
    
    if ($producto['stock'] >= $cantidad) {
        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = [];
        }

        if (isset($_SESSION['carrito'][$id_producto])) {
            $_SESSION['carrito'][$id_producto]['cantidad'] += $cantidad;
        } else {
            $_SESSION['carrito'][$id_producto] = [
                'nombre' => $producto['nombre_producto'],
                'precio' => $producto['precio'],
                'cantidad' => $cantidad
            ];
        }
        return true;
    }
    return false;
}

function mostrarCarrito() {
    if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0) {
        foreach ($_SESSION['carrito'] as $id_producto => $item) {
            $total_unitario = $item['precio'] * $item['cantidad'];
            echo "Producto: " . $item['nombre'] . "\n";
            echo "Precio: " . $item['precio'] . "\n";
            echo "Cantidad: " . $item['cantidad'] . "\n";
            echo "Total Unitario: " . $total_unitario . "\n";
            echo "Eliminar opción (ID: $id_producto)\n";
        }
    } else {
        echo "El carrito está vacío.\n";
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_producto = $_POST['id_producto'];
    $cantidad = $_POST['cantidad'];
    
    if (agregarAlCarrito($id_producto, $cantidad)) {
        echo "Producto agregado al carrito.\n";
    } else {
        echo "No hay suficiente stock para agregar ese producto.\n";
    }
}

mostrarCarrito();
?>
