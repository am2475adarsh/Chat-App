<?php
include('config/db_connect.php');


if (isset($_POST['submit'])) {

    $name = mysqli_real_escape_string($conn, $_POST['names']);
    $password = mysqli_real_escape_string($conn, $_POST['passwords']);
    $repassword = mysqli_real_escape_string($conn, $_POST['repassword']);

    $sql = "SELECT * FROM chat_table where names = '$name'";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $user_data = mysqli_fetch_assoc($result);
        if ($user_data['names'] == $name) {

            echo "User Exists use another name";
        }
    }

    //create sql

    //save to db and check
    else {
        if (mysqli_query($conn, $sql) && $password == $repassword) {

            // $id = $_SESSION['id'] = $_POST['id'];
            // $names = $_SESSION['name'] = $_POST['Name'];
            // $price = $_SESSION['price'] = $_POST['price'];
            // $description = $_SESSION['description'] = $_POST['description'];
            //success
            $succes = 1;
            $sql = "INSERT INTO chat_table(names,passwords) VALUES('$name','$password')";
            mysqli_query($conn, $sql);
            header('location: login.php');
        } else {
            //error
            echo 'query error' . mysqli_error($conn);
        }

        //echo 'form is valid';
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

                <div class="box">
                    <label for="">Re-Password : </label>
                    <input type="text" name="repassword" required>
                </div>

                <input type="submit" value="Submit" class="submit" name="submit">
            </div>
        </form>
    </section>
</body>

</html>