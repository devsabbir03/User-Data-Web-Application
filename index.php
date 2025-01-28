<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Data</title>
    <?php include './css.php'; ?>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>List of Users</h2>
        <a href="./create.php" class="btn" role="button">Add New User</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "userdata";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            //read all row from database table
            $sql = "SELECT * FROM users";
            $result = $conn->query($sql);
            

            if (!$result) {
                die("Query failed: " . $conn->error);
            }

            //read data of each row
            while($row = $result->fetch_assoc()){
                echo "
                <tr>
                    <td>$row[id]</td>
                    <td>$row[name]</td>
                    <td>$row[email]</td>
                    <td>$row[phone]</td>
                    <td>$row[address]</td>
                    <td>
                        <a href='./edit.php?id=$row[id]' class='btn-edit' role='button'>Edit</a>
                        <a href='./delete.php?id=$row[id]' class='btn-delete' role='button'>Delete</a>
                    </td>
                </tr>
                ";
            }

            ?>

                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>