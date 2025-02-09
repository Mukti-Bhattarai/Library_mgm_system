<?php 

$servername = "localhost";
$username = "root";
$password = "";

$conn = mysqli_connect($servername, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$dbname = "mydb";
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";

if ($conn->query($sql) === TRUE) {
    ob_start();
    echo "Database created successfully or already exists.<br>";
    ob_end_clean();
} else {
    
    if ($conn->errno == 1007) { 
        echo "Database already exists.<br>";
    } else {
        echo "Error creating database: " . $conn->error . "<br>";
    }
}

mysqli_select_db($conn, $dbname);

$query = "CREATE TABLE IF NOT EXISTS library (
    ISBN INT(12) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Book_Name VARCHAR(30) NOT NULL,
    Author VARCHAR(30) NOT NULL,
    Units VARCHAR(50)
)";

if ($conn->query($query) === TRUE) {
    ob_start();
    echo "Table created successfully";
    ob_end_clean();
} else {
    echo "Error creating table: " . $conn->error;
}

?>