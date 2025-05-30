<?php

/**
 *    File        : backend/controllers/studentsController.php
 *    Project     : CRUD PHP
 *    Author      : Tecnologías Informáticas B - Facultad de Ingeniería - UNMdP
 *    License     : http://www.gnu.org/licenses/gpl.txt  GNU GPL 3.0
 *    Date        : Mayo 2025
 *    Status      : Prototype
 *    Iteration   : 3.0 ( prototype )
 */

//No se cambió nada extra desde la versión 2.0, sigue con sus chequeos de errores y todo... 
//(EDIT: Se cambió el retorno de las creaciones y actualizaciones, ahora sabemos cuántas filas fueron afectadas).

require_once("./models/students.php");

function handleGet($conn)
{
    $input = json_decode(file_get_contents("php://input"), true);

    if (isset($input['id'])) { //Si se recibió una id. Buscamos un estudiante con esa id. Si nó, nos traemos a todos los estudiantes.
        $student = getStudentById($conn, $input['id']);
        echo json_encode($student);
    } else {
        $students = getAllStudents($conn);
        echo json_encode($students);
    }
}

function handlePost($conn)
{
    $input = json_decode(file_get_contents("php://input"), true);

    $result = createStudent($conn, $input['fullname'], $input['email'], $input['age']); //Retorna la cantidad de filas afectadas (Cantidad de estudiantes creados)
    if ($result['inserted'] > 0) {
        echo json_encode(["message" => "Estudiante agregado correctamente"]);
    } else {
        http_response_code(500);
        echo json_encode(["error" => "No se pudo agregar"]);
    }
}

function handlePut($conn)
{
    $input = json_decode(file_get_contents("php://input"), true);

    $result = updateStudent($conn, $input['id'], $input['fullname'], $input['email'], $input['age']);
    if ($result['updated'] > 0) {
        echo json_encode(["message" => "Actualizado correctamente"]);
    } else {
        http_response_code(500);
        echo json_encode(["error" => "No se pudo actualizar"]);
    }
}

function handleDelete($conn)
{
    $input = json_decode(file_get_contents("php://input"), true);

    $result = deleteStudent($conn, $input['id']);
    if ($result['deleted'] > 0) {
        echo json_encode(["message" => "Eliminado correctamente"]);
    } else {
        http_response_code(500);
        echo json_encode(["error" => "No se pudo eliminar"]);
    }
}
