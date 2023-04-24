<?php

session_start();

$con = mysqli_connect("localhost", "root", "", "studentsworks");
mysqli_set_charset($con, "utf8");
