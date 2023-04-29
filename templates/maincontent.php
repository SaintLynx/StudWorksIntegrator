<section class="form">
    <h2 class="form-title">Форма отправки темы научной работы</h2>
    <p class="alert"><?= $false_name; ?></p>
    <p class="alert"><?= $false_year; ?></p>
    <p class="alert"><?= $false_sup; ?></p>
    <p class="alert"><?= $false_work; ?></p>
    <form class="main-form" method="POST" action="/index.php" enctype="multipart/form-data" autocomplete="off">
        <label for="student_name" class="name-lable">ФИО обучающегося(-йся) 
            <input class="name-input" type="text" id="student_name" name="student_name" placeholder="Введите Фамилию Имя Отчество" value="<?= $_SESSION['user_surname'] . ' ' . $_SESSION['user_name'] . ' ' .  $_SESSION['user_last_name']; ?>">
        </label>
        <label class="year-lable">Курс 
            <select class="year-select" name="year_of_study">
                    <option selected></option>
                <?php foreach ($years_of_study as $year_of_study): ?>
                    <option><?= $year_of_study["year_of_study"]; ?></option>
                <?php endforeach; ?>
            </select>
        </label>
        <label class="supervisor-lable">Научный руководитель 
            <select class="supervisor-select" name="supervisor_name">
                    <option selected></option>
                <?php foreach ($supervisor_cards as $supervisor_card): ?>
                    <option><?= $supervisor_card["supervisor_name"]; ?></option>
                <?php endforeach; ?>
            </select>
        </label>
        <label class="name-lable">Название работы (комментарии можно оставить здесь)
        <textarea class="textarea" name="work_name" placeholder="Начните вводить здесь тему научного исследования..."></textarea>
        </label>
        <input class="button" type="submit" value="Отправить">
    </form>
</section>
<section class="supervisor-section">
    <h2>Карточки научных руководителей</h2>
    <ul class="cards">
        <?php foreach ($supervisor_cards as $supervisor_card): ?>
            <li class="card">
            <img class="card-img" src="<?= $supervisor_card["supervisor_photo"]; ?>" width="150" height="150" alt="<?= $supervisor_card["supervisor_name"]; ?>">
            <div class="card-content">
                <h3 class="card-supervisor"><?= $supervisor_card["supervisor_name"]; ?></h3>
                <p class="card-status"><?= $supervisor_card["supervisor_status"]; ?></p>
                <p class="card-text"><?= $supervisor_card["supervisor_interests"]; ?></p>
                <a href="<?= $supervisor_card["supervisor_site"]; ?>" class="card-more">Подробнее...</a>
            </div>
            </li>
        <?php endforeach; ?>
    </ul>
</section>