<?php
require_once ("functions.php");
require_once ("init.php");

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

$main_content = include_template("maincontent.php", [
    "years_of_study" => $years_of_study,
    "supervisors" => $supervisors
]);

$layout_content = include_template("layout.php", [
    "main_content" => $main_content
]);

print($layout_content);
