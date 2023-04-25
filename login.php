<?php
require_once ("init.php");

$empty_email = '';
$incorrect_password = '';
$wrong_email = '';
$wrong_password = '';

if (count($_POST) > 0) {
    $error_counter = 0;

    if (strlen($_POST['user_email']) === 0) {
        $empty_email = "Поле с email не может быть пустым!";
        $error_counter++;
    }

    if (strlen($_POST['password']) === 0) {
        $incorrect_password = "Поле с паролем не может быть пустым!";
        $error_counter++;
    }

    if ($error_counter === 0) {
        $user_email = htmlspecialchars($_POST['user_email']);
        $password = htmlspecialchars($_POST['password']);

        if (!$con) {
                $error = mysqli_connect_error();
            } else {
                $sql = "SELECT id, user_surname, user_name, user_last_name, user_email, user_password FROM users WHERE user_email='$user_email';";
                $result = mysqli_query($con, $sql);
                if (!$result) {
                $error = mysqli_error($con);
            } else {
                $user_data = mysqli_fetch_assoc($result);
            };
        };

        if ($user_data) {
            if (password_verify($password, $user_data["user_password"])) {
                session_start();
                $_SESSION['user_surname'] = $user_data["user_surname"];
                $_SESSION['user_name'] = $user_data["user_name"];
                $_SESSION['user_last_name'] = $user_data["user_last_name"];
                $_SESSION['id'] = $user_data["id"];
                header("Location: /index.php");
            } else {
                $wrong_password = "Вы ввели неверный пароль";
            }
        } else {
            $wrong_email = "Пользователь с таким еmail не зарегестрирован";
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
        <title>Вход</title>
    </head>
    <body>
        <main class="sign-up">
            <form class="sign-up_form" action="/login.php" method="POST" autocomplete="off" enctype="multipart/form-data">
                <h2>Интегратор Студенческих Работ</h2>
                <div class="sign-up_item">
                    <p class="alert-sign-up"><?= $empty_email; ?></p>
                    <p class="alert-sign-up"><?= $wrong_email; ?></p>
                    <label for="email">E-mail: </label>
                    <input id="email" type="text" name="user_email" placeholder="Введите e-mail" value="<?= $_POST["user_email"] ?? ''; ?>">
                </div>
                <div class="sign-up_item">
                    <p class="alert-sign-up"><?= $incorrect_password; ?></p>
                    <p class="alert-sign-up"><?= $wrong_password; ?></p>
                    <label for="password">Пароль: </label>
                    <input id="password" type="password" name="password" placeholder="Введите пароль">
                </div>
                <button type="submit" class="button">Войти</button>
                <a class="login-link" href="/sign-up.php">Создать аккаунт</a>
            </form>
        </main>
    </body>
</html>