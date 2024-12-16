<?php
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/Database.php';
include_once '../models/User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

$method = $_SERVER['REQUEST_METHOD'];

switch($method) {
    case 'GET':
        $stmt = $user->read();
        $num = $stmt->rowCount();

        if($num > 0) {
            $users_arr = array();
            $users_arr["records"] = array();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $user_item = array(
                    "id" => $id,
                    "email" => $email
                );
                array_push($users_arr["records"], $user_item);
            }

            http_response_code(200);
            echo json_encode($users_arr);
        } else {
            http_response_code(404);
            echo json_encode(array("message" => "No users found."));
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"));

        if(!empty($data->email)) {
            $user->email = $data->email;

            if($user->create()) {
                http_response_code(201);
                echo json_encode(array("message" => "User was created."));
            } else {
                http_response_code(503);
                echo json_encode(array("message" => "Unable to create user."));
            }
        } else {
            http_response_code(400);
            echo json_encode(array("message" => "Unable to create user. Data is incomplete."));
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(array("message" => "Method not allowed"));
        break;
}