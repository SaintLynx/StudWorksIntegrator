<?php
require_once ("init.php");
require_once ("functions.php");

session_start();

$false_name = '';
$false_year = '';
$false_sup = '';
$false_work = '';

if (isset($_SESSION['user_surname'])) {
    if (!$con) {
            $error = mysqli_connect_error();
        } else {
            $sql = "SELECT year_of_study FROM years_of_study";
            $result = mysqli_query($con, $sql);
            if (!$result) {
            $error = mysqli_error($con);
        } else {
            $years_of_study = mysqli_fetch_all($result, MYSQLI_ASSOC);
        };
    };

    if (!$con) {
            $error = mysqli_connect_error();
        } else {
            $sql = "SELECT * FROM supervisor_cards";
            $result = mysqli_query($con, $sql);
            if (!$result) {
            $error = mysqli_error($con);
        } else {
            $supervisor_cards = mysqli_fetch_all($result, MYSQLI_ASSOC);
        };
    };

    if (count($_POST) > 0) {
        $error_counter = 0;

        if (strlen($_POST['student_name']) === 0) {
            $false_name = "Поле с ФИО не может быть пустым!";
            $error_counter++;
        }

        if (strlen($_POST['year_of_study']) === 0) {
            $false_year = "Выберите курс!";
            $error_counter++;
        }

        if (strlen($_POST['supervisor_name']) === 0) {
            $false_sup = "Выберите научного руководителя!";
            $error_counter++;
        }

        if (strlen($_POST['work_name']) < 5) {
            $false_work = "Название работы не может быть короче 5 знаков!";
            $error_counter++;
        }

        if ($error_counter === 0) {
            $student_name = mysqli_real_escape_string($con, $_POST['student_name']);
            $year_of_study = $_POST['year_of_study'];
            $supervisor_name = $_POST['supervisor_name'];
            $work_name = mysqli_real_escape_string($con, $_POST['work_name']);
            $user_id = $_SESSION['id'];

            if (isset($_FILES['work_file'])) {
                $file_name = $_FILES['work_file']['name'];
                $file_path = __DIR__ . '/uploads/';
                $file_url = '/uploads/' . $file_name;
                move_uploaded_file($_FILES['work_file']['tmp_name'], $file_path . $file_name);
            };

            if (!$con) {
                    $error = mysqli_connect_error();
                } else {
                    $sql = "INSERT INTO studentsworkstable SET student_name=?, year_of_study=?, supervisor_name=?, work_name=?, user_id=?, work_file=? ON DUPLICATE KEY UPDATE student_name=?, year_of_study=?, supervisor_name=?, work_name=?, work_file=?;";
                    $stmt = mysqli_prepare($con, $sql);
                    mysqli_stmt_bind_param($stmt, 'sissississs', $student_name, $year_of_study, $supervisor_name, $work_name, $user_id, $file_url, $student_name, $year_of_study, $supervisor_name, $work_name, $file_url);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    if (!$result) {
                    $error = mysqli_error($con);
                };
            };
            header('Location: /success.php');
        }
    };

    $main_content = include_template("maincontent.php", [
        "supervisor_cards" => $supervisor_cards,
        "years_of_study" => $years_of_study,
        "false_name" => $false_name,
        "false_year" => $false_year,
        "false_sup" => $false_sup,
        "false_work" => $false_work
    ]);

    $layout_content = include_template("layout.php", [
        "main_content" => $main_content
    ]);

    print($layout_content);
} else {
    header("Location: /login.php");
};
