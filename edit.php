<?php
ob_clean();
header('Content-Type: application/json');
include "dbconnection.php";

$id = isset($_POST['id']) ? $_POST['id'] : '';

if(!empty($id)){
    $stmt = $conn->prepare("SELECT id, name, email FROM student WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if($row = $result->fetch_assoc()){
        echo json_encode($row);
    } else {
        echo json_encode(["error" => "not_found"]);
    }
} else {
    echo json_encode(["error" => "invalid_id"]);
}
exit;
?>