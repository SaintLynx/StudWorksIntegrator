<?php
require_once ("init.php");
require_once ("functions.php");

session_start();

if (isset($_SESSION['user_surname'])) {
    if (!$con) {
            $error = mysqli_connect_error();
        } else {
            $sql = "SELECT supervisor_name FROM supervisor_cards";
            $result = mysqli_query($con, $sql);
            if (!$result) {
            $error = mysqli_error($con);
        } else {
            $supervisors = mysqli_fetch_all($result, MYSQLI_ASSOC);
        };
    };

    if (isset($_GET['supervisor_name'])) {
        if ($_GET['supervisor_name'] === 'Все') {
            if (!$con) {
                $error = mysqli_connect_error();
            } else {
                $sql = "SELECT student_name, year_of_study, supervisor_name, work_name, date_creation FROM studentsworkstable ORDER BY year_of_study, date_creation DESC;";
                $result = mysqli_query($con, $sql);
                if (!$result) {
                    $error = mysqli_error($con);
                } else { 
                    $getrows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                }
            }
        } else {
            $supervisor_select = $_GET['supervisor_name'];
            if (!$con) {
                $error = mysqli_connect_error();
            } else {
                $sql = "SELECT student_name, year_of_study, supervisor_name, work_name, date_creation FROM studentsworkstable WHERE supervisor_name='$supervisor_select' ORDER BY year_of_study, date_creation DESC;";
                $result = mysqli_query($con, $sql);
                if (!$result) {
                $error = mysqli_error($con);
                } else {
                $getrows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                };
            }; 
        };
    }  else { 
        $getrows = []; 
    };

    $main_tables = include_template("maintables.php", [
        "supervisors" => $supervisors,
        "getrows" => $getrows
    ]);

    $layout_content = include_template("layout.php", [
        "main_content" => $main_tables
    ]);

    print($layout_content);
} else {
    header("Location: /login.php");
};