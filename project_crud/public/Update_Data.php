<?php
require('con_table.php');

$sql = "SELECT * FROM library";
$result = $conn->query($sql);

if (!$result) {
    die("Query failed: " . $conn->error);
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Update Records</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.cdnfonts.com/css/minecraft-3" rel="stylesheet">
  <link rel="stylesheet" href="./style.css">
  <script src="./js/data.js" type="module" charset="utf-8" defer></script>
  <script src="./js/dataManager.js" type="module" charset="utf-8" defer></script>
  <script src="https://kit.fontawesome.com/f06ee4b06e.js" crossorigin="anonymous"></script>
    <style>
.table-container {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 1150px;
  margin: 0 auto;
}

.nav-buttons {
  display: flex;
  justify-content: flex-start;
  width: fit-content;
  padding: 10px;
}

section {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  width: 100vw;
  padding: 0 50px;
}

#footer-txt {
  padding: 10px 0;
}

table {
  width: 80%;
  max-width: 800px;
  margin: 20px auto;  /* Ensures the table is centered horizontally */
  border-collapse: separate;
  border-spacing: 0;
  border-radius: 5px;
  overflow: hidden;
}

    th, td {
      padding: 10px;
      text-align: center;
      background-color: #2a2a2a; 
      border: none; 
    }
    th {
      background-color: #fd7014; 
    }

  </style>
</head>

<body class="bg-[#393e46] h-[100vh] sm:h-full min-h-[100vh] flex flex-col justify-between">
  <nav class="bg-cover bg-[#222831] flex flex-row justify-between p-2 w-full">
  <a href="../index.html">
    <img src="../assets/Chakravuya-Archives.png" alt="" class="w-[40vw]">
  </a>
  <div class="nav-buttons">
<a href="./Add_Data.html" class="list-none text-white bg-orange-500 py-1 px-2 rounded">Add</a>

</div>
</nav>
  
  <main class="container flex flex-col justify-center items-center">
    <h1 class="text-white text-3xl mt-8 m-2">Records...</h1>
   <section class="container flex flex-col justify-center items-center w-full" style="width: 100vw; padding: 0 50px;">
      <div class="table-container">
        <table class="min-w-full bg-gray-800 text-white">
          <thead>
            <tr>
              <th>Book ISBN</th>
              <th>Book Name</th>
              <th>Author</th>
              <th>Units</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
              <tr class="hover:bg-gray-700">
                <td><?php echo $row['ISBN']; ?></td>
                <td><?php echo $row['Book_Name']; ?></td>
                <td><?php echo $row['Author']; ?></td>
                <td><?php echo $row['Units']; ?></td>
                <td>
                  <div class="flex justify-center gap-2">
                    <a href="edit.php?isbn=<?php echo $row['ISBN']; ?>" class="bg-blue-500 text-white py-1 px-2 rounded">Edit</a>
                    <form action="delete.php" method="POST" style="display:inline;">
                      <input type="hidden" name="isbn" value="<?php echo $row['ISBN']; ?>">
                      <button type="submit" class="bg-red-500 text-white py-1 px-2 rounded" onclick="return confirm('Are you sure you want to delete this record?');">Delete</button>
                    </form>
                  </div>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </section>
  </main>

  <footer class="bg-[#222831]">
    <p class="text-sm text-white text-center" id="footer-txt">&copy;</p>
  </footer>
  <script>
    const myparagraph = document.querySelector("#footer-txt");
    myparagraph.textContent += ` ${new Date().getFullYear()} Team Chakravuya All Rights Reserved `;
  </script>
</body>

</html>
