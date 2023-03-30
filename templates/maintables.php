<section class="form-select">
    <h2 class="form-title">Темы научных работ</h2>
    <form name="signup" method="GET" action="form.php" enctype="multipart/form-data"></form>
        <label class="supervisor-lable-select">Научный руководитель 
            <select class="supervisor-select-select" name="supervisor_name" required>
                <?php foreach ($supervisors as $supervisor): ?>
                    <option value="Выбирите научного руководителя"><?= $supervisor["supervisor_name"]; ?></option>
                <?php endforeach; ?>
            </select>
        </label>
        <input class="button" type="submit" name="send" value="Отправить">
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
            </tr>
        </thead>
        <tbody class="table-body">
            <tr>
                <td class="modify">1</td>
                <td>Закиров Айдар Робертович</td>
                <td class="modify">2</td>
                <td>Зазнаев Олег Иванович</td>
                <td>Лоббизм в всех странах и мирах</td>
            </tr>
        </tbody>
    </table>
</section>