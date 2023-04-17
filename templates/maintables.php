<section class="form-select">
    <h2 class="form-title">Темы научных работ</h2>
    <form method="GET" action="/tables.php" enctype="multipart/form-data">
        <label class="supervisor-lable-select">Научный руководитель 
            <select class="supervisor-select-select" name="supervisor_name" required>
                    <option selected></option>
                <?php foreach ($supervisors as $supervisor): ?>
                    <option><?= $supervisor["supervisor_name"]; ?></option>
                <?php endforeach; ?>
            </select>
        </label>
        <input class="button" type="submit" value="Отправить">
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
            <?php $counter = 1; foreach ($getrows as $getrow): ?>
                <tr>
                    <td class="col1"><?= $counter++; ?></td>
                    <td class="col2"><?= htmlspecialchars($getrow["student_name"]); ?></td>
                    <td class="col3"><?= htmlspecialchars($getrow["year_of_study"]); ?></td>
                    <td class="col4"><?= htmlspecialchars($getrow["supervisor_name"]); ?></td>
                    <td class="col5"><?= htmlspecialchars($getrow["work_name"]); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>
