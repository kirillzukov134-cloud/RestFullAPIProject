<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json");

// Обработка (OPTIONS) запросов
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}
//Выводит всех студентов
function SelectAllStudents($pdo){
    $sql = "SELECT * FROM students";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($results);
}

//Выводит одного студента
function SelectIDStudents($pdo, $id){
    $sql = "SELECT `name`, `surname`, `groups`, `email` FROM `students` WHERE id = :id";
    $statement = $pdo->prepare($sql);
    $statement->bindParam(":id", $id);
    $statement->execute();
        
        if($statement->rowCount() > 0){
            $results = $statement->fetch(PDO::FETCH_ASSOC);
            echo json_encode($results);
        } else{
            http_response_code(404);
                $response = [
                    "status" => "error",
                    "message"=> "Student not found!"
                ];
            echo json_encode($response);
        }
}

//Добавление студента
function AdditionStudents($pdo, $data){
    $sql = "INSERT INTO `students`(`name`, `surname`, `groups`, `email`) VALUES (:name, :surname, :groups, :email)";
    $statement = $pdo->prepare($sql);
    $statement->execute($data);

    if($statement){
            $response = [
        "status"=> true,
        "message"=> "Successfully added student!",
        "id" => $pdo->lastInsertId()
    ];
    echo json_encode($response);
    }else {
        http_response_code(403);
        $response = [
            "status"=> "error",
            "message"=> "Error adding student!"
        ];
        echo json_encode($response);
    }
}

//Удаление студента
function DeleteStudent($pdo, $id){
    $sql = "DELETE FROM `students` WHERE id = :id";
    $statement = $pdo->prepare($sql);
    $statement->execute([":id" => $id]);
    
    if($statement->rowCount() > 0){
        $response = [
            "status" => true,
            "message"=> "Успешно удалено"
        ];
        echo json_encode($response);
    } else {
        http_response_code(400);
        $response = [
            "status" => false,
            "message"=> "Ошибка при удалении студента"
        ];
        echo json_encode($response);
    }
}

//Редактирование студента (Обновление)
function UpdateStudent($pdo, $id, $data){
    $data['id'] = $id;
    $sql = "UPDATE `students` SET `name`= :name , `surname`= :surname, `groups`= :groups, `email`= :email WHERE id = :id";
    $statement = $pdo->prepare($sql);
    
    if($statement->execute($data)){
        $response = [
            "status" => true,
            "message" => "Successfully updated",
        ];
        echo json_encode($response);
    } else {
        http_response_code(400);
        $response = [
            "status" => "error",
            "message" => "Error updating student!"
        ];
        echo json_encode($response);
    }
}