<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Philosopher:ital,wght@0,400;0,700;1,400&family=Roboto:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
        <link href="/css/style.css" rel="stylesheet">
        <title>(ИСР)Интегратор Студенческих Работ</title>
    </head>
    <body>
        <header class="header">
            <div class="header-container">
                <h1 class="header-title">Интегратор Студенческих Работ(ИСР) </h1>
                <p class="header-info">Проект в рамках "Разработка IT-продукта" на "Цифровых кафедрах" ИТИС КФУ</p>
                <nav class="main-nav">
                <ul class="site-navigation">
                    <li class="site-navigation-item <?php if($_SESSION['user_name'] === 'admin'): print('hidden'); endif; ?>"><a href="/index.php">Форма</a></li>
                    <li class="site-navigation-item <?php if($_SESSION['user_name'] === 'admin'): print('hidden'); endif; ?>"><a href="/tables.php">Таблица</a></li>
                </ul>
                </nav>
            </div>
            <div class="user-container">
                <p class="user-name"><?= $_SESSION['user_surname']; ?></p>
                <p class="user-name"><?= $_SESSION['user_name']; ?></p>
                <a class="logout" href="logout.php">Выйти</a>
            </div>
        </header>
        <main class="main-content"><?= $main_content; ?></main>
        <footer class="footer">
            <p class="dev">Закиров А., Булатов И., Салихов А., Кузнецова А. Команда №6, РИТП 4.1</p>
            <p class="copyright">Интегратор Студенческих Работ ©2023 Все права защищены</p>
            <p class="copyright"><a href="/login-manager.php">Для администратора</a></p>
        </footer>
        <button class="up-button" type="button">↑<span class="hidden">Наверх</span></button>
        <script src="/script.js"></script>
    </body>
</html>
