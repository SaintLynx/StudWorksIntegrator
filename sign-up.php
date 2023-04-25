<?php
require_once ("init.php");

session_start();

$incorrect_surname = '';
$incorrect_name = '';
$incorrect_last_name = '';
$empty_email = '';
$incorrect_email = '';
$incorrect_password = '';
$incorrect_password_copy = '';

if (count($_POST) > 0) {
    $error_counter = 0;

    if (strlen($_POST['user_surname']) === 0) {
        $incorrect_surname = "Поле с фамилией не может быть пустым!";
        $error_counter++;
    }

    if (strlen($_POST['user_name']) === 0) {
        $incorrect_name = "Поле с именем не может быть пустым!";
        $error_counter++;
    }

    if (strlen($_POST['user_last_name']) === 0) {
        $incorrect_last_name = "Поле с отчеством не может быть пустым!";
        $error_counter++;
    }

    if (strlen($_POST['user_email']) === 0) {
        $empty_email = "Поле с email не может быть пустым!";
        $error_counter++;
    }

    if (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
        $incorrect_email = "Не правильный формат почты";
        $error_counter++;
    }

    if (strlen($_POST['user_password']) < 5) {
        $incorrect_password = "Пароль не может быть короче 5 знаков!";
        $error_counter++;
    }

    if ($_POST['user_password_copy'] !== $_POST['user_password']) {
        $incorrect_password_copy = "Пароли не совпадают!";
        $error_counter++;
    }

    if ($error_counter === 0) {
        $user_surname = htmlspecialchars($_POST['user_surname']);
        $user_name = htmlspecialchars($_POST['user_name']);
        $user_last_name = htmlspecialchars($_POST['user_last_name']);
        $user_email = htmlspecialchars($_POST['user_email']);
        $user_password = password_hash($_POST['user_password'], PASSWORD_DEFAULT);
        $user_password_copy = password_hash($_POST['user_password_copy'], PASSWORD_DEFAULT);

        if (!$con) {
                $error = mysqli_connect_error();
            } else {
                $sql = "INSERT INTO users SET user_surname=?, user_name=?, user_last_name=?, user_email=?, user_password=?;";
                $stmt = mysqli_prepare($con, $sql);
                mysqli_stmt_bind_param($stmt, 'sssss', $user_surname, $user_name, $user_last_name, $user_email, $user_password);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                if (!$result) {
                $error = mysqli_error($con);
            };
        };
        header('Location: /success-sign-up.php');
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
        <title>Регистрация</title>
    </head>
    <body>
        <main class="sign-up">
            <form class="sign-up_form" action="/sign-up.php" method="POST" autocomplete="off" enctype="multipart/form-data">
                <h2>Регистрация нового аккаунта</h2>
                <div class="sign-up_item">
                    <p class="alert-sign-up"><?= $incorrect_surname; ?></p>
                    <label for="surname">Фамилия: </label>
                    <input id="surname" type="text" name="user_surname" placeholder="Введите фамилию" value="<?= $_POST["user_surname"] ?? ''; ?>">
                </div>
                <div class="sign-up_item">
                    <p class="alert-sign-up"><?= $incorrect_name; ?></p>
                    <label for="name">Имя: </label>
                    <input id="name" type="text" name="user_name" placeholder="Введите имя" value="<?= $_POST["user_name"] ?? ''; ?>">
                </div>
                <div class="sign-up_item">
                    <p class="alert-sign-up"><?= $incorrect_last_name; ?></p>
                    <label for="last_name">Отчество: </label>
                    <input id="last_name" type="text" name="user_last_name" placeholder="Введите отчество" value="<?= $_POST["user_last_name"] ?? ''; ?>">
                </div>
                <div class="sign-up_item">
                    <p class="alert-sign-up"><?= $empty_email; ?></p>
                    <p class="alert-sign-up"><?= $incorrect_email; ?></p>
                    <label for="email">E-mail: </label>
                    <input id="email" type="text" name="user_email" placeholder="Введите e-mail" value="<?= $_POST["user_email"] ?? ''; ?>">
                </div>
                <div class="sign-up_item">
                    <p class="alert-sign-up"><?= $incorrect_password; ?></p>
                    <label for="password">Пароль: </label>
                    <input id="password" type="password" name="user_password" placeholder="Введите пароль">
                </div>
                <div class="sign-up_item">
                    <p class="alert-sign-up"><?= $incorrect_password_copy; ?></p>
                    <label for="password_copy">Повторите пароль: </label>
                    <input id="password_copy" type="password" name="user_password_copy" placeholder="Повторите пароль">
                </div>
                <button type="submit" class="button">Зарегистрироваться</button>
                <a class="login-link" href="/login.php">Уже есть аккаунт</a>
            </form>
        </main>
    </body>
</html>