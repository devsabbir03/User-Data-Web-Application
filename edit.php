<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "userdata";

//create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$id = $name = $email = $phone = $address = "";

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == 'GET') {
    //get method to get user data

    if ( isset($_GET['id']) ) {
        header("Location: ./index.php");
        exit;
    }

    $id = $_GET['id'];

    //read the row of selected user from database
    $sql = "SELECT * FROM users WHERE id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("Location: ./index.php");
        exit;
    }

    $name = $row['name'];
    $email = $row['email'];
    $phone = $row['phone'];
    $address = $row['address'];

}else {
    //post method to update user data
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    do {
        if (empty($name) || empty($email) || empty($phone) || empty($address)) {
            $error = "All the fields are required";
            break;
        }

        //update user data in database
        $sql = "UPDATE users SET name='$name', email='$email', phone='$phone', address='$address' WHERE id=$id";

        $result = $conn->query($sql);

        if (!$result) {
            $error = "Failed to update user data";
            break;
        }

        $success = "User data updated successfully";

        header("Location: ./index.php");
        exit;

    }while(false);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container2">
        <h2>New User</h2>
        <?php
        if (!empty($error)) {
            echo "<div class='alert alert-danger'>".$error."</div>";
        }

        ?>

        <form method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="row1">
            <label class="col-sm-3">Name</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="name" value="<?php echo $name; ?>" required>
            </div>
            <div class="row0">
            <label class="col-sm-4">Email</label>
            <div class="col-sm-7">
                <input type="email" class="form-control" name="email" <?php echo $email; ?> required>
            </div>
        </div>
        <div class="row1">
            <label class="col-sm-5">Phone</label>
            <div class="col-sm-8">
                <input type="number" class="form-control" name="phone" <?php echo $phone; ?> required>
            </div>
            <div class="row1">
            <label class="col-sm-5">Address</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="address" <?php echo $address; ?> required>
            </div>

            <?php
            if (!empty($success)) {
                echo "<div class='alert alert-success'>".$success."</div>";
            }
            ?>

            <div class="row2">
                <div class="offset-sm-3">
                    <button type="submit" class="btn-submit">Submit</button>
                </div>
                <div class="col-sm-9">
                    <a href="./index.php" class="btn-back" role="button">Back</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>