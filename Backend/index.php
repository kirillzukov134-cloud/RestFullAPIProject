<?php

require "./Config/connectDB.php";
require "./Functions/functions.php";

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json");

$method = $_SERVER['REQUEST_METHOD'];

$q = $_GET['q'];
$params = explode('/', $q);
$type = $params[0];
$id = $params[1];


switch ($method) {
    //Вывод всех | одного студента
    case 'GET':
        if ($type === 'students') {
            if($id){
                SelectIDStudents($pdo, $id);
            }else {
                SelectAllStudents($pdo);
            }
        }
    break;
    //Добавление студента
    case 'POST':
        if ($type === 'students') {
            AdditionStudents($pdo, $_POST);
        }else {
            http_response_code(404);
            echo json_encode([
                'status'=> 'error',
                'message'=> 'Ошибка при добавлении']);
        }
    break;
    //Редактирование студента
    case 'PATCH':
        if ($type === 'students') {
            if(!empty($id)){
                $data = json_decode(file_get_contents('php://input'), true);
                UpdateStudent($pdo, $id, $data);
            } else {
                http_response_code(404);
                echo json_encode([
                    'status'=> 'error',
                    'message'=> 'Требуется ID студента для редактирования'
                ]);
            }
        }
    break;
    //Удаление студента
    case 'DELETE':
        if ($type === 'students') {
            if(!empty($id)){
                    DeleteStudent($pdo, $id);
                }
            }else{
                http_response_code(404);
                echo json_encode([
                    'status'=> 'error',
                    'message'=> 'Ошибка при удалении'
                ]);
            }
    break;
    //Проверка на подходящий метод...           
    default:
        http_response_code(405);
        $response = [
            'status'=> 'error',
            'message'=> 'Нет подходящего метода'
        ];
        echo json_encode($response);
    break;
}

    
