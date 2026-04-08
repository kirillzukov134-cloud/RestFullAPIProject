<?php

require "./Config/connectDB.php";
require "./Functions/functions.php";

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json");

$method = $_SERVER['REQUEST_METHOD'];

$q = $_GET['q'];
$params = explode('/', $q);
$type = $params[0];
$id = $params[1];

if($method === 'GET'){
    if($type === 'students'){
        if(!empty($id)){
            SelectIDStudents($pdo, $id);
        } else {
            SelectAllStudents($pdo);
        }
    }
} else if($method === 'POST'){
    if($type === 'students'){
        AdditionStudents($pdo, $_POST);
    }
} else if($method === 'DELETE'){
    if($type === 'students'){
        if(!empty($id)){
            DeleteStudent($pdo, $id);
        }
    }
} else if($method === 'PATCH'){
    if($type === 'students'){
        $data = json_decode(file_get_contents('php://input'), true);
        UpdateStudent($pdo, $id, $data);
    }
} else {
        http_response_code(405);
    $response = [
        'status'=> 'error',
        'message'=> 'Не правильно выбран метод или метод не настроен!'
    ];
    echo json_encode($response);
}


    
