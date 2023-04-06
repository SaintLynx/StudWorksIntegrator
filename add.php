<?php

require_once ("init.php");

$student_name = mysqli_real_escape_string($con, $_POST['student_name']);
$year_of_study = $_POST['year_of_study'];
$supervisor_name = $_POST['supervisor_name'];
$work_name = mysqli_real_escape_string($con, $_POST['work_name']);

$errors = [];

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
