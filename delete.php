<?php
include "dbconnection.php";

$id = isset($_POST['id']) ? $_POST['id'] : '';

if(!empty($id)){
    $stmt = $conn->prepare("DELETE FROM student WHERE id = ?");
    $stmt->bind_param("i", $id);

    if($stmt->execute()){
        echo "Record deleted successfully";
    } else {
        echo "Delete failed";
    }
} else {
    echo "Invalid ID";
}
?>