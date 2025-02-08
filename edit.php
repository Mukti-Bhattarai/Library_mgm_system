<?php
require('con_table.php');
    $isbn = $_GET['isbn'];

  $sql = "SELECT * FROM library WHERE isbn = $isbn"; 
    $result = $conn->query($sql);

    // Check if the record exists
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        die("Record not found.");
    }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['bookName'];
    $author = $_POST['author'];
    $unit = $_POST['quantity'];

    $update_sql = "UPDATE library SET book_name = '$name', author = '$author', units = $unit WHERE isbn = $isbn"; 

    if ($conn->query($update_sql) === TRUE) {
        header("Location: read.php"); 
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['bookName'];
    $author = $_POST['author'];
    $unit = $_POST['quantity'];

    // Update the data in the database
    $update_sql = "UPDATE library SET book_name = ?, author = ?, units = ? WHERE isbn = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("ssii", $name, $author, $unit, $isbn); 

    if ($update_stmt->execute()) {
        header("Location: read.php"); 
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
</head>
<body>
    <h1>Edit Book</h1>
    <form action="edit.php?isbn=<?php echo $isbn; ?>" method="POST">
        <label for="bookName">Book Name:</label>
        <input type="text" id="bookName" name="bookName" value="<?php echo htmlspecialchars($row['Book_Name']); ?>" required>
        <br>
        <label for="author">Author:</label>
        <input type="text" id="author" name="author" value="<?php echo htmlspecialchars($row['Author']); ?>" required>
        <br>
        <label for="quantity">Units:</label>
        <input type="number" id="quantity" name="quantity" value="<?php echo htmlspecialchars($row['Units']); ?>" required>
        <br>
        <button type="submit">Update</button>
    </form>
</body>
</html>

<?php
$conn->close(); 
?>