<section class="form-section">
    <h2 class="form-title">Темы научных работ</h2>
    <form class="main-form" name="signup" method="GET" action="form.php" enctype="multipart/form-data"></form>
        <div class="form-item-one">
        <label>Научный руководитель <select name="supervisor_name" required>
        <?php foreach ($supervisors as $supervisor): ?>
            <option value="Выбирите научного руководителя"><?= $supervisor["supervisor_name"]; ?></option>
            <?php endforeach; ?>
        </select></label>
        </div>
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