<?php
require 'conexion.php';
try {
    $sql = "
    CREATE TABLE IF NOT EXISTS recetario (
        id SERIAL PRIMARY KEY,
        nombre VARCHAR(255) NOT NULL,
        descripcion TEXT,
        ingredientes TEXT,
        instrucciones TEXT,
        categoria VARCHAR(100),
        tiempo_prep INT,
        porciones INT,
        dificultad VARCHAR(50)
    );

    ALTER TABLE recetario ADD COLUMN IF NOT EXISTS imagen_url VARCHAR(255);

    INSERT INTO recetario (nombre, descripcion, ingredientes, instrucciones, categoria, tiempo_prep, porciones, dificultad, imagen_url) VALUES

    ('Tacos de Asada', 'Clásicos tacos norteños con carne asada jugosa', '500g carne asada, 10 tortillas de harina, 1 cebolla, cilantro, limones, salsa', '1. Asar la carne a fuego alto. 2. Rebanar en trozos pequeños. 3. Servir en tortillas con cebolla y cilantro.', 'Comida', 30, 4, 'Fácil', 'https://images.unsplash.com/photo-1565299585323-38d6b0865b47?w=600'),
    ('Enchiladas Rojas', 'Enchiladas bañadas en salsa roja con queso y crema', '12 tortillas de maíz, 300g pollo cocido, 4 chiles guajillo, 2 jitomates, queso fresco, crema', '1. Hacer la salsa con chiles y jitomate. 2. Rellenar tortillas con pollo. 3. Bañar con salsa y gratinar.', 'Comida', 45, 4, 'Media', 'https://images.unsplash.com/photo-1534352956036-cd81e27dd615?w=600'),
    ('Guacamole', 'Guacamole fresco estilo mexicano', '3 aguacates, 1 jitomate, 1/2 cebolla, cilantro, 1 limón, sal, chile serrano', '1. Machacar los aguacates. 2. Agregar jitomate, cebolla y cilantro picados. 3. Sazonar con limón y sal.', 'Botana', 10, 4, 'Fácil', 'https://images.unsplash.com/photo-1553909489-cd47e0907980?w=600'),
    ('Pozole Rojo', 'Pozole rojo tradicional mexicano para ocasiones especiales', '1kg maíz pozolero, 800g carne de cerdo, 5 chiles guajillo, 2 chiles ancho, ajo, cebolla, orégano', '1. Cocer el maíz hasta que reviente. 2. Hacer el caldo con carne y chiles. 3. Mezclar y hervir 20 min.', 'Cena', 120, 8, 'Difícil', 'https://images.unsplash.com/photo-1604908176997-125f25cc6f3d?w=600'),
    ('Hotcakes', 'Hotcakes esponjosos para el desayuno', '2 tazas harina, 2 huevos, 1 taza leche, 2 cdas mantequilla, 1 cda azúcar, 1 cdita polvo para hornear', '1. Mezclar ingredientes secos. 2. Agregar húmedos y mezclar. 3. Cocinar en sartén caliente.', 'Desayuno', 20, 4, 'Fácil', 'https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?w=600'),
    ('Sopa de Lima', 'Sopa yucateca de lima con pollo desmenuzado', '1 pollo, 4 limas, 1 cebolla, 2 jitomates, tortillas fritas, orégano, chile dulce', '1. Cocer el pollo y desmenuzar. 2. Hacer el caldo con verduras. 3. Agregar jugo de lima y servir con tostadas.', 'Comida', 60, 6, 'Media', 'https://images.unsplash.com/photo-1547592180-85f173990554?w=600'),
    ('Flan Napolitano', 'Flan cremoso con caramelo dorado', '1 lata leche condensada, 1 lata leche evaporada, 3 huevos, 1 cdita vainilla, 1 taza azúcar para caramelo', '1. Hacer caramelo y verter en molde. 2. Licuar el resto. 3. Hornear a baño María 45 min.', 'Postre', 70, 8, 'Media', 'https://images.unsplash.com/photo-1551024506-0bccd828d307?w=600'),
    ('Chilaquiles Rojos', 'Desayuno clásico mexicano con tortillas en salsa roja', '10 tortillas fritas, 3 chiles guajillo, 2 jitomates, crema, queso fresco, cebolla, huevos (opcional)', '1. Freír las tortillas. 2. Hacer salsa con chiles y jitomate. 3. Bañar tortillas con salsa caliente.', 'Desayuno', 25, 3, 'Fácil', 'https://images.unsplash.com/photo-1504544750208-dc0358e63f7f?w=600'),
    ('Arroz con Leche', 'Postre clásico cremoso con canela', '1 taza arroz, 1 litro leche, 3/4 taza azúcar, 1 raja canela, cáscara de limón, canela en polvo', '1. Cocer el arroz en agua. 2. Agregar leche, azúcar y canela. 3. Hervir a fuego bajo hasta espesar.', 'Postre', 40, 6, 'Fácil', 'https://images.unsplash.com/photo-1586201375761-83865001e31c?w=600'),
    ('Caldo de Res', 'Caldo reconfortante de res con verduras', '1kg chambarete, 2 elotes, 3 papas, 2 zanahorias, 1/4 col, ejotes, 1 cebolla, ajo, sal', '1. Cocer la carne con cebolla y ajo. 2. Agregar verduras en orden de dureza. 3. Sazonar y servir.', 'Cena', 90, 6, 'Fácil', 'https://images.unsplash.com/photo-1603105037880-880cd4edfb0d?w=600');
    ";
    $pdo->exec($sql);
    echo "Done";
} catch(Exception $e) {
    echo "Error: " . $e->getMessage();
}
