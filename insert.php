<?php
include "dbconnection.php";
$data = json_decode(file_get_contents("php://input"), true);

$name = $data['name'];
$email = $data['email'];
$password = $data['password'];

if(!empty($name) && !empty($email) && !empty($password)){
    $check = $conn->prepare("SELECT id FROM student WHERE email=?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if($check->num_rows > 0){
        echo "Email already exists";
        exit;
    }

    $hash = password_hash($password, PASSWORD_BCRYPT);
    $stmt = $conn->prepare("INSERT INTO student(name,email,password) VALUES(?,?,?)");
    $stmt->bind_param("sss", $name, $email, $hash);
    echo $stmt->execute() ? "success" : "failed";
} else {
    echo "empty fields";
}
?>