<?php
include "dbconnection.php";

$id = isset($_POST['id']) ? $_POST['id'] : '';
$name = isset($_POST['name']) ? $_POST['name'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

if(!empty($id) && !empty($name) && !empty($email)){
    if(!empty($password)) {
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $conn->prepare("UPDATE student SET name=?, email=?, password=? WHERE id=?");
        $stmt->bind_param("sssi", $name, $email, $hash, $id);
    } else {
        $stmt = $conn->prepare("UPDATE student SET name=?, email=? WHERE id=?");
        $stmt->bind_param("ssi", $name, $email, $id);
    }
    echo $stmt->execute() ? "success" : "failed";
} else {
    echo "empty fields";
}
?>