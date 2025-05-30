<?php

/**
 *    File        : backend/routes/studentsRoutes.php
 *    Project     : CRUD PHP
 *    Author      : Tecnologías Informáticas B - Facultad de Ingeniería - UNMdP
 *    License     : http://www.gnu.org/licenses/gpl.txt  GNU GPL 3.0
 *    Date        : Mayo 2025
 *    Status      : Prototype
 *    Iteration   : 3.0 ( prototype )
 */

require_once("./config/databaseConfig.php");
require_once("./routes/routesFactory.php");
require_once("./controllers/studentsController.php");

// routeRequest($conn);


/**
 * Ejemplo de como se extiende un archivo de rutas 
 * para casos particulares
 * o validaciones:
 */
routeRequest($conn, [
    'POST' => function ($conn)  //Qué tiene que pasar si el método es POST (Crear nuevo estudiante)
    {
        // Validación o lógica extendida
        $input = json_decode(file_get_contents("php://input"), true); //Lee el cuerpo del mensaje HTTP (en formato JSON) y lo convierte en un array PHP. 
        //  php://input es el cuerpo bruto de la solicitud. (Se usa cuando no viene de un formulario clásico, como lo que hace fetch() en Javascript) 
        if (empty($input['fullname']))  //Si el campo fullname no existe o está vacio, mostramos un error
        {
            http_response_code(400);
            echo json_encode(["error" => "Falta el nombre"]);
            return;
        }
        handlePost($conn); //Ejecutamos handlePost que está en el controlador del estudiante.
    }
]);
