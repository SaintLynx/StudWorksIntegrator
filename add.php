<?php

require ("init.php");

$student_name = mysqli_real_escape_string($con, $_POST['student_name']);
$year_of_study = $_POST['year_of_study'];
$supervisor_name = $_POST['supervisor_name'];
$work_name = mysqli_real_escape_string($con, $_POST['work_name']);

if (!$con) {
        $error = mysqli_connect_error();
    } else {
        $sql = "INSERT INTO studentsworkstable SET student_name='$student_name', year_of_study='$year_of_study', supervisor_name='$supervisor_name', work_name='$work_name';";
        $result = mysqli_query($con, $sql);
        if (!$result) {
        $error = mysqli_error($con);
    };
};

header('Location: /success.php');
