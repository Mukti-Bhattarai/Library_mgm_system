<?php
require('con_table.php');

// Execute the SQL query
$sql = "SELECT * FROM library";
$result = $conn->query($sql);

// Check if the query was successful
if (!$result) {
    die("Query failed: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data List</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .edit-button, .delete-button {
            padding: 5px 10px;
            border: none;
            color: white;
            cursor: pointer;
        }
        .edit-button {
            background-color: #4CAF50; /* Green */
        }
        .delete-button {
            background-color: #f44336; /* Red */
        }
    </style>
</head>
<body>
    <h1>Read</h1>
    <a href="add.php">Add New</a> <br><br>
    <table>
        <tr>
            <th>ISBN</th>
            <th>Book Name</th> 
            <th>Author</th>
            <th>Units</th>
            <th>Edit/Delete</th>
        </tr>
        <?php
        // Fetch and display the data
        while ($row = $result->fetch_assoc()) {
        ?>
        <tr>
            <td><?php echo $row['ISBN']; ?></td>
            <td><?php echo $row['Book_Name']; ?></td> 
            <td><?php echo $row['Author']; ?></td>
            <td><?php echo $row['Units']; ?></td> 
            <td>
                <div class="action-buttons">
                    <a href="edit.php?isbn=<?php echo $row['ISBN']; ?>" class="edit-button">Edit</a> <!-- Edit button -->
                    <form action="delete.php" method="POST" style="display:inline;">
                        <input type="hidden" name="isbn" value="<?php echo $row['ISBN']; ?>">
                        <button type="submit" class="delete-button" onclick="return confirm('Are you sure you want to delete this record?');">Delete</button>
                    </form>
                </div>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>

<?php
$conn->close(); 
?>