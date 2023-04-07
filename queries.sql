-- Добавляем в таблицу научных руководителей ФИО преподавателей (обязательно для развертывания)
INSERT INTO supervisors (supervisor_name, supervisor_code)
VALUES
    ('Зазнаев Олег Иванович', '1'),
    ('Сергеев Сергей Алексеевич', '2'),
    ('Дубровин Владимир Юрьевич', '3'),
    ('Сидоров Виктор Владимирович', '4'),
    ('Игонин Денис Иванович', '5'),
    ('Гарипов Руслан Фаритович', '6'),
    ('Авзалова Эльмира Илгизовна', '7'),
    ('Закиров Айдар Робертович', '8'),
    ('Зарипова Айгуль Раисовна', '9'),
    ('Фазулов Азат Ревгатович', '10'),
    ('Мурзина Диляра Шамилевна', '11');

-- Добавляем в таблицу курсов указание года обучения (обязательно для развертывания)
INSERT INTO years_of_study (year_of_study)
VALUES
    ('1'),
    ('2'),
    ('3'),
    ('4');

-- Добавляем в таблицу наименований студенческих работ данные из формы
INSERT INTO studentsworkstable SET student_name='$student_name', year_of_study='$year_of_study', supervisor_name='$supervisor_name', work_name='$work_name';

-- Формируем запрос в БД с указанием выбранного научного руководителя с сортировкой по курсу обучения
SELECT student_name, year_of_study, supervisor_name, work_name FROM studentsworkstable WHERE supervisor_name='$supervisor_select' ORDER BY year_of_study;

-- Формируем запрос на получение все списка наименований студенческих работ
SELECT student_name, year_of_study, supervisor_name, work_name FROM studentsworkstable ORDER BY year_of_study;