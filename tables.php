<?php
require ("functions.php");
require ("init.php");

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

$main_tables = include_template("maintables.php", [
    "supervisors" => $supervisors
]);

$layout_content = include_template("layout.php", [
    "main_content" => $main_tables
]);

print($layout_content);

?>