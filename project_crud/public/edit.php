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

    // Using prepared statement to update the data
    $update_sql = "UPDATE library SET book_name = ?, author = ?, units = ? WHERE isbn = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("ssii", $name, $author, $unit, $isbn);

    if ($update_stmt->execute()) {
        header("Location: Update_Data.php"); 
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.cdnfonts.com/css/minecraft-3" rel="stylesheet">
    <link rel="stylesheet" href="./style.css">
</head>

<body class="bg-[#393e46] min-h-[100vh] flex flex-col justify-between w-full">
    <nav class="bg-cover bg-[#222831] flex flex-row justify-between p-4">
        <a href="../index.html">
            <img src="../assets/Chakravuya-Archives.png" alt="Logo" class="w-[40vw]">
        </a>
        <div class="flex gap-2 pr-4">
            <a href="#">
                <li class="list-none text-white bg-orange-500 py-1 px-2 rounded">Add</li>
            </a>
            <a href="./read.php">
                <li class="list-none text-white bg-orange-500 py-1 px-2 rounded">Update</li>
            </a>
        </div>
    </nav>

    <main class="h-[80vh] sm:my-16 sm:h-full flex flex-col justify-center bg-[#393E46] items-center">
        <h1 class="mb-6 text-3xl text-white">Edit Book</h1>
        <form action="edit.php?isbn=<?php echo $isbn; ?>" method="POST" class="flex flex-col justify-around bg-[#fd7014] p-6 mx-4 rounded-lg mb-10 w-full md:w-1/2">
            <div class="form-group mb-4">
                <label for="bookName" class="text-lg text-white">Book Name</label>
                <input type="text" id="bookName" name="bookName" value="<?php echo htmlspecialchars($row['Book_Name']); ?>" class="w-full text-lg py-2 px-4 rounded mt-2" required>
            </div>
            <div class="form-group mb-4">
                <label for="author" class="text-lg text-white">Author</label>
                <input type="text" id="author" name="author" value="<?php echo htmlspecialchars($row['Author']); ?>" class="w-full text-lg py-2 px-4 rounded mt-2" required>
            </div>
            <div class="form-group mb-4">
                <label for="quantity" class="text-lg text-white">Units</label>
                <input type="number" id="quantity" name="quantity" value="<?php echo htmlspecialchars($row['Units']); ?>" class="w-full text-lg py-2 px-4 rounded mt-2" required>
            </div>
            <div class="flex justify-center">
                <button type="submit" class="bg-white text-black text-lg py-2 px-6 rounded mt-4">Update</button>
            </div>
        </form>

        <div class="flex justify-center mt-4">
            <a href="Update_Data.php">
                <button class="bg-white text-black text-lg py-2 px-6 rounded">View All Records</button>
            </a>
        </div>
    </main>
</body>
</html>

<?php
$conn->close();
?>
