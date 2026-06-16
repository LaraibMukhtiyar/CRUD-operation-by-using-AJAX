<?php
include "dbconnection.php";

$result = $conn->query("SELECT * FROM student");

$output = "";

while($row = $result->fetch_assoc()){
    
    $output .= "<tr>
        <td>{$row['id']}</td>
        <td>{$row['name']}</td>
        <td>{$row['email']}</td>
        <td>{$row['password']}</td>
        <td>
            <button class='btn btn-warning btn-sm edit' data-id='{$row['id']}'>Edit</button>
            <button class='btn btn-danger btn-sm delete' data-id='{$row['id']}'>Delete</button>
        </td>
    </tr>";
}

echo $output;
?>