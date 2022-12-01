<?php
session_start();
include('config/db_connect.php');

if (isset($_POST['submit'])) {
    // "mysqli_real_escape_string" this helps unwanted or harmful data to get into our database
    $name = mysqli_real_escape_string($conn, $_POST['names']);
    $password = mysqli_real_escape_string($conn, $_POST['passwords']);


    $sql = "SELECT * FROM chat_table where names= '$name'";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $user_data = mysqli_fetch_assoc($result);
        if ($user_data['names'] == $name && $user_data['passwords'] == $password) {
            $name = $_SESSION['user_names'] = $_POST['names'];
            $password = $_SESSION['user_password'] = $_POST['passwords'];
            header('location: home.php');
        } else {
            echo "<script>alert('Wrong Credentials !');</script>";
        }
    } else {
        echo "<script>alert('No such User !');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <section class="photo">

    </section>

    <section class="main">
        <form method="post">
            <div class="container">
                <div class="box">
                    <label for="">Name : </label>
                    <input type="text" name='names' style="margin-left: 43px;" required>
                </div>

                <div class="box">
                    <label for="">Password : </label>
                    <input type="text" name='passwords' style="margin-left: 20px;" required>
                </div>

                <input type="submit" value="Submit" class="submit" name="submit">
            </div>
        </form>
    </section>

</body>

</html>