<?php
require_once ("init.php");

$empty_login = '';
$incorrect_password = '';
$wrong_login = '';
$wrong_password = '';

if (count($_POST) > 0) {
    $error_counter = 0;

    if (strlen($_POST['admin_name']) === 0) {
        $empty_login = "Поле с логином не может быть пустым!";
        $error_counter++;
    }

    if (strlen($_POST['admin_password']) === 0) {
        $incorrect_password = "Поле с паролем не может быть пустым!";
        $error_counter++;
    }

    if ($error_counter === 0) {
        $admin_login = htmlspecialchars($_POST['admin_name']);
        $password = htmlspecialchars($_POST['admin_password']);

        if (!$con) {
                $error = mysqli_connect_error();
            } else {
                $sql = "SELECT id, admin_surname, admin_name, admin_password FROM admins WHERE admin_name='$admin_login';";
                $result = mysqli_query($con, $sql);
                if (!$result) {
                $error = mysqli_error($con);
                } else {
                $admin_data = mysqli_fetch_assoc($result);
                };
            };

        if ($admin_data) {
            if (password_verify($password, $admin_data["admin_password"])) {
                session_start();
                $_SESSION['id'] = $admin_data["id"];
                $_SESSION['user_surname'] = $admin_data["admin_surname"];
                $_SESSION['user_name'] = $admin_data["admin_name"];
                header("Location: /manager.php");
            } else {
                $wrong_password = "Вы ввели неверный пароль";
            }
        } else {
            $wrong_login = "Администратор с таким логином не зарегестрирован";
        };
    }
};
?>

<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Philosopher:ital,wght@0,400;0,700;1,400&family=Roboto:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
        <link href="/css/style.css" rel="stylesheet">
        <title>Вход для администратора</title>
    </head>
    <body>
        <main class="sign-up">
            <form class="sign-up_form" action="/login-manager.php" method="POST" autocomplete="off" enctype="multipart/form-data">
                <h2>Интегратор Студенческих Работ (Администратор)</h2>
                <div class="sign-up_item">
                    <p class="alert-sign-up"><?= $empty_login; ?></p>
                    <p class="alert-sign-up"><?= $wrong_login; ?></p>
                    <label for="email">Логин: </label>
                    <input id="email" type="text" name="admin_name" placeholder="Введите логин">
                </div>
                <div class="sign-up_item">
                    <p class="alert-sign-up"><?= $incorrect_password; ?></p>
                    <p class="alert-sign-up"><?= $wrong_password; ?></p>
                    <label for="password">Пароль: </label>
                    <input id="password" type="password" name="admin_password" placeholder="Введите пароль">
                </div>
                <button type="submit" class="button">Войти</button>
                <a class="login-link" href="/index.php">На главную</a>
            </form>
        </main>
    </body>
</html>