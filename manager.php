<?php
require_once ("init.php");
require_once ("functions.php");

session_start();

if (isset($_SESSION['user_surname'])) {
    $empty_supervisor_name = '';
    $empty_status = '';
    $empty_interests = '';
    $empty_site = '';
    $empty_avatar = '';

    
    if (count($_POST) > 0) {
        $error_counter = 0;

        if (strlen($_POST['supervisor_name']) === 0) {
            $empty_supervisor_name = "Поле с ФИО не может быть пустым!";
            $error_counter++;
        }

        if (strlen($_POST['supervisor_status']) === 0) {
            $empty_status = "Поле со статусом не может быть пустым!";
            $error_counter++;
        }

        if (strlen($_POST['supervisor_interests']) === 0) {
            $empty_interests = "Поле с интересами не может быть пустым!";
            $error_counter++;
        }

        if (strlen($_POST['supervisor_site']) === 0) {
            $empty_site = "Укажите URL!";
            $error_counter++;
        }

        if ($_FILES['supervisor_photo']['size'] === 0) {
            $empty_avatar = "Выберите фаил!";
            $error_counter++;
        }

        if($error_counter === 0) {
            $supervisor_name = $_POST['supervisor_name'];
            $supervisor_status = $_POST['supervisor_status'];
            $supervisor_interests = 'Научные интересы: ' . $_POST['supervisor_interests'];
            $supervisor_site = $_POST['supervisor_site'];

            if (isset($_FILES['supervisor_photo'])) {
                $file_name = $_FILES['supervisor_photo']['name'];
                $file_path = __DIR__ . '/img/';
                $file_url = '/img/' . $file_name;
                move_uploaded_file($_FILES['supervisor_photo']['tmp_name'], $file_path . $file_name);
            };

            if (!$con) {
                    $error = mysqli_connect_error();
                } else {
                    $sql = "INSERT INTO supervisor_cards SET supervisor_name=?, supervisor_photo=?, supervisor_status=?, supervisor_interests=?, supervisor_site=?;";
                    $stmt = mysqli_prepare($con, $sql);
                    mysqli_stmt_bind_param($stmt, 'sssss', $supervisor_name, $file_url, $supervisor_status, $supervisor_interests, $supervisor_site);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    if (!$result) {
                    $error = mysqli_error($con);
                };
            };
            header('Location: /success-card-change.php');
        };
    };

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
                $sql = "SELECT student_name, year_of_study, supervisor_name, work_name, work_file FROM studentsworkstable ORDER BY year_of_study;";
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
                $sql = "SELECT student_name, year_of_study, supervisor_name, work_name, work_file, work_file FROM studentsworkstable WHERE supervisor_name='$supervisor_select' ORDER BY year_of_study;";
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

    $main_manager = include_template("mainmanager.php", [
        "supervisors" => $supervisors,
        "getrows" => $getrows,
        "empty_supervisor_name" => $empty_supervisor_name,
        "empty_status" => $empty_status,
        "empty_interests" => $empty_interests,
        "empty_site" => $empty_site,
        "empty_avatar" => $empty_avatar
    ]);

    $layout_content = include_template("layout.php", [
        "main_content" => $main_manager
    ]);

    print($layout_content);
} else {
    header("Location: /login-manager.php");
};