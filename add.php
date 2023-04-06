<?php

require_once ("init.php");

if (count($_POST) > 0) {
    $error_counter = 0;

    if (strlen($_POST['student_name']) === 0) {
        echo "Поле с ФИО не может быть пустым<br>";
        $error_counter++;
    }

    if (strlen($_POST['year_of_study']) === 0) {
        echo "Выберите курс<br>";
        $error_counter++;
    }

    if (strlen($_POST['supervisor_name']) === 0) {
        echo "Выберите научного руководителя<br>";
        $error_counter++;
    }

    if (strlen($_POST['work_name']) < 5) {
        echo "Название работы не может быть короче 5 знаков<br>";
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
