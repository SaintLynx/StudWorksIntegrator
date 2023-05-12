<?php 
require_once ("init.php");

if (!$con) {
    $error = mysqli_connect_error();
} else {
    $supervisor = htmlspecialchars($_POST['supervisor_name']);
    $sql = "DELETE FROM supervisor_cards WHERE supervisor_name='$supervisor';";
    $result = mysqli_query($con, $sql);
    print($sql);
    if ($result) {
        header("Location: /manager.php");    
    } else {
        $error = mysqli_error($con);
        print($error);
    };
};
