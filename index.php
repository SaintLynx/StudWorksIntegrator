<?php
require_once ("functions.php");
require_once ("init.php");

$false_name = '';
$false_year = '';
$false_sup = '';
$false_work = '';

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
        $sql = "SELECT supervisor_name FROM supervisors";
        $result = mysqli_query($con, $sql);
        if (!$result) {
        $error = mysqli_error($con);
    } else {
        $supervisors = mysqli_fetch_all($result, MYSQLI_ASSOC);
    };
};

if (count($_POST) > 0) {
    $error_counter = 0;

    if (strlen($_POST['student_name']) === 0) {
        $false_name = "Поле с ФИО не может быть пустым<br>";
        $error_counter++;
    }

    if (strlen($_POST['year_of_study']) === 0) {
        $false_year = "Выберите курс<br>";
        $error_counter++;
    }

    if (strlen($_POST['supervisor_name']) === 0) {
        $false_sup = "Выберите научного руководителя<br>";
        $error_counter++;
    }

    if (strlen($_POST['work_name']) < 5) {
        $false_work = "Название работы не может быть короче 5 знаков<br>";
        $error_counter++;
    }

    if ($error_counter === 0) {
        $student_name = mysqli_real_escape_string($con, $_POST['student_name']);
        $year_of_study = $_POST['year_of_study'];
        $supervisor_name = $_POST['supervisor_name'];
        $work_name = mysqli_real_escape_string($con, $_POST['work_name']);

        if (!$con) {
                $error = mysqli_connect_error();
            } else {
                $sql = "INSERT INTO studentsworkstable SET student_name=?, year_of_study=?, supervisor_name=?, work_name=?;";
                $stmt = mysqli_prepare($con, $sql);
                mysqli_stmt_bind_param($stmt, 'siss', $student_name, $year_of_study, $supervisor_name, $work_name);
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
    "years_of_study" => $years_of_study,
    "supervisors" => $supervisors,
    "false_name" => $false_name,
    "false_year" => $false_year,
    "false_sup" => $false_sup,
    "false_work" => $false_work
]);

$layout_content = include_template("layout.php", [
    "main_content" => $main_content
]);

print($layout_content);
