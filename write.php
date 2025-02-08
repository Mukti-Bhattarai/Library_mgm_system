<?php
require('con_table.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $isbn = $_POST['isbn'];
    $name = $_POST['bookName'];
    $author = $_POST['author'];
    $unit = $_POST['quantity'];

    $sql = "INSERT INTO library (isbn, book_name, author, units) VALUES ('$isbn', '$name', '$author', '$unit')"; 
    if ($conn->query($sql) === TRUE) {
        
        header("Location: read.php?isbn=$isbn&bookName=$name&author=$author&quantity=$unit");
        exit(); 
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error; 
    }
}

$conn->close(); 
?>