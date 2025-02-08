 <?php
require('con_table.php');

        $isbn = $_POST['isbn'];
        $delete_sql = "DELETE FROM library WHERE isbn = $isbn"; 

        if ($conn->query($delete_sql) === TRUE) {
            header("Location: read.php"); 
            exit();
        } else {
            echo "Error deleting record: " . $conn->error;
        }

$conn->close(); 
?>