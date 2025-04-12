<?php
include("conexion.php");

$categorias = $conexion->query("SELECT * FROM categorias");

function generarRutaImagen($nombre) {
    $nombre_formateado = strtolower(str_replace(' ', '_', $nombre));
    $nombre_formateado = str_replace(['(', ')', ',', '.', 'á', 'é', 'í', 'ó', 'ú', 'ñ'], 
                                     ['', '', '', '', 'a', 'e', 'i', 'o', 'u', 'n'], 
                                     $nombre_formateado);
    return "img/$nombre_formateado.jpg";
}

while($cat = $categorias->fetch_assoc()) {
    echo "Categoría: " . $cat['nombre_categoria'] . "\n";
    
    $id_categoria = $cat['id_categoria'];
    $productos = $conexion->query("
        SELECT * FROM productos 
        WHERE id_categoria = $id_categoria 
        ORDER BY precio ASC 
        LIMIT 3
    ");
    
    while($prod = $productos->fetch_assoc()) {
        $ruta_img = generarRutaImagen($prod['nombre_producto']);
        echo "Producto: " . $prod['nombre_producto'] . "\n";
        echo "Imagen: " . $ruta_img . "\n";
        echo "Precio: " . $prod['precio'] . "\n";
        echo "Stock: " . $prod['stock'] . "\n";
    }
}
?>
