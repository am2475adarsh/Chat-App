<?php
session_start();
include('config/db_connect.php');
$user = $_SESSION['user_names'];

if (isset($_POST['submit'])) {

    $to_name = mysqli_real_escape_string($conn, $_POST['to_names']);

    $sql = "SELECT * FROM chat_table where names = '$to_name'";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $user_data = mysqli_fetch_assoc($result);
        if ($user_data['names'] == $to_name) {
            $to_name = $_SESSION['to_names'] = $_POST['to_names'];
            $sql = "SELECT * FROM message_info where ((p1 = '$to_name' and p2='$user') or (p1='$user' and p2 = '$to_name'))";
            $result = mysqli_query($conn, $sql);
            if ($result && mysqli_num_rows($result) > 0) {
                // echo "meow";
                header('location: message.php');
            } else {
                $sql = "INSERT INTO message_info(p1,p2) VALUES('$user','$to_name')";
                mysqli_query($conn, $sql);
                header('location: message.php');
            }
        }
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
    <link rel="stylesheet" href="homestyle.css">
</head>

<body>
    <div class="parent">
        <form method="post">
            <div class="inner">

                <div class="box">
                    <label for="">Enter username : </label>
                    <input type="text" name="to_names">
                </div>

                <div class="box">
                    <input type="submit" name="submit" value="Start Session" style="margin-left: 110px;">
                </div>
            </div>
        </form>
    </div>
</body>

</html>