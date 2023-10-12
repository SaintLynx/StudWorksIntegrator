<section class="form-select">
    <h2 class="form-title">Темы научных работ обучающихся</h2>
    <form method="GET" action="/manager.php" enctype="multipart/form-data">
        <label class="supervisor-lable-select">Научный руководитель  
        <select class="supervisor-select-select" name="supervisor_name" required>
                <option selected></option>
            <?php foreach ($supervisors as $supervisor): ?>
                <option><?= $supervisor["supervisor_name"]; ?></option>
            <?php endforeach; ?>
                <option>Все</option>
        </select>
        </label>
        <button class="button" type="submit">Отправить</button>
    </form>
</section>
<section class="table-section">
    <table class="main-table">
        <thead class="table-head">
            <tr>
                <th>№</th>
                <th>ФИО обучающегося</th>
                <th>Курс</th>
                <th>Научный руководитель</th>
                <th>Название темы</th>
                <th>Фаил</th>
            </tr>
        </thead>
        <tbody class="table-body">
            <?php $counter = 1; foreach ($getrows as $getrow): ?>
                <tr>
                    <td class="col1"><?= $counter++; ?></td>
                    <td class="col2"><?= htmlspecialchars($getrow["student_name"]); ?></td>
                    <td class="col3"><?= htmlspecialchars($getrow["year_of_study"]); ?></td>
                    <td class="col4"><?= htmlspecialchars($getrow["supervisor_name"]); ?></td>
                    <td class="col5"><?= htmlspecialchars($getrow["work_name"]); ?></td>
                    <td class="col6 <?php if($getrow["work_file"] === '/uploads/'): print('tablecell'); endif; ?>"><a href="<?= $getrow["work_file"]; ?>">Скачать</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>
<section class="admin-cards">
    <h2 class="admin-form-title">Создание карточки научного руководителя</h2>
    <form method="POST" action="/manager.php" enctype="multipart/form-data" autocomplete="off">
        <div class="sign-up_item">
            <p class="alert-sign-up"><?= $empty_supervisor_name; ?></p>
            <label for="supervisor_name">ФИО научного руководителя: </label>
            <input id="supervisor_name" type="text" name="supervisor_name" placeholder="Фамилия Имя Отчество" value="<?= $_POST["supervisor_name"] ?? ''; ?>">
        </div>
        <div class="sign-up_item">
            <p class="alert-sign-up"><?= $empty_status; ?></p>
            <label for="supervisor_status">Должность, ученая степень, ученое звание: </label>
            <input id="supervisor_status" type="textarea" name="supervisor_status" placeholder="Должность, ученая степень, ученое звание" value="<?= $_POST["supervisor_status"] ?? ''; ?>">
        </div>
        <div class="sign-up_item">
            <p class="alert-sign-up"><?= $empty_interests; ?></p>
            <label for="supervisor_interests">Научные интересы: </label>
            <input id="supervisor_interests" type="textarea" name="supervisor_interests" placeholder="Научные интересы научного руководителя" value="<?= $_POST["supervisor_interests"] ?? ''; ?>">
        </div>
        <div class="sign-up_item">
            <p class="alert-sign-up"><?= $empty_site; ?></p>
            <label for="supervisor_site">Ссылка на персональную страницу КФУ: </label>
            <input id="supervisor_site" type="text" name="supervisor_site" placeholder="Введите URL" value="<?= $_POST["supervisor_site"] ?? ''; ?>">
        </div>
        <div class="sign-up_item">
            <p class="alert-sign-up"><?= $empty_avatar; ?></p>
            <label for="supervisor_photo">Аватар научного руководителя (формат квадрат): </label>
            <input id="supervisor_photo" type="file" name="supervisor_photo">
        </div>
        <input class="button" type="submit" value="Отправить">
    </form>
</section>
<section class="card-off">
    <h2 class="form-title">Удаление карточки научного руководителя (действие не обратимо!)</h2>
    <form method="POST" action="/card-off.php" enctype="multipart/form-data">
        <label class="supervisor-lable-select">Выберите карточку
        <select class="supervisor-select-select" name="supervisor_name" required>
                <option selected></option>
            <?php foreach ($supervisors as $supervisor): ?>
                <option><?= $supervisor["supervisor_name"]; ?></option>
            <?php endforeach; ?>
        </select>
        </label>
        <input class="button" type="submit" value="Удалить">
    </form>
</section>