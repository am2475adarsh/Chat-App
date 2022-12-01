<?php
//connect to database
$conn = mysqli_connect('localhost', 'adarsh', 'test1234', 'chat_app');

//check connection
if (!$conn) {
    echo 'Connection error:' . mysqli_connect_error();
}
