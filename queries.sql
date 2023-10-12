-- Добавляем в таблицу карточек научных руководителей их данные (обязательно для развертывания)
INSERT INTO supervisor_cards (supervisor_name, supervisor_photo, supervisor_status, supervisor_interests, supervisor_site)
VALUES
    ('З****** О****** И******', '/img/placeholder.svg', 'Заведующий кафедрой политологии, доктор юридических наук, профессор', 'Научные интересы: политические институты, формы правления', 'https://kpfu.ru/Oleg.Zaznaev'),
    ('С****** С****** А******', '/img/placeholder.svg', 'Профессор кафедры политологии, доктор политических наук, профессор', 'Научные интересы: этнические процессы, правые и левые движения', 'https://kpfu.ru/sergej.sergeev'),
    ('Д****** В****** Ю******', '/img/placeholder.svg', 'Доцент кафедры политологии, кандидат исторических наук, доцент', 'Научные интересы: история политической мысли, политические мифы', 'https://kpfu.ru/Vladimir.Dubrovin'),
    ('С****** В****** В******', '/img/placeholder.svg', 'Доцент кафедры политологии, кандидат политических наук', 'Научные интересы: политические партии, избирательные системы, Европейский Союз', 'https://kpfu.ru/Viktor.Sidorov'),
    ('И****** Д****** И******', '/img/placeholder.svg', 'Доцент кафедры политологии, кандидат политических наук, доцент', 'Научные интересы: миграционные процессы', 'https://kpfu.ru/denis.igonin'),
    ('Г****** Р****** Ф******', '/img/placeholder.svg', 'Доцент кафедры политологии, кандидат юридических наук', 'Научные интересы: правовые аспекты деятельности политических институтов', 'https://kpfu.ru/ruslanf.garipov'),
    ('А****** Э****** И******', '/img/placeholder.svg', 'Доцент кафедры политологии, кандидат политических наук, доцент', 'Научные интересы: политическая коммуникация', 'https://kpfu.ru/elmira.avzalova'),
    ('З****** А****** Р******', '/img/placeholder.svg', 'Доцент кафедры политологии, кандидат политических наук, доцент', 'Научные интересы: лоббизм и группы интересов, геополитика', 'https://kpfu.ru/ajdarr.zakirov'),
    ('З****** А****** Р******', '/img/placeholder.svg', 'Доцент кафедры политологии, кандидат политических наук, доцент', 'Научные интересы: региональные процессы, политические технологии', 'https://kpfu.ru/ajgulr.zaripova'),
    ('Ф****** А****** Р******', '/img/placeholder.svg', 'Доцент кафедры политологии, кандидат политических наук', 'Научные интересы: система местного самоуправления', 'https://kpfu.ru/Azat.Fazulov'),
    ('М****** Д****** Ш******', '/img/placeholder.svg', 'Доцент кафедры политологии, кандидат политических наук', 'Научные интересы: политическая культура и мифология', 'https://kpfu.ru/dilyara.murzina');

-- Добавляем в таблицу научных руководителей ФИО преподавателей для запроса (обязательно для развертывания)
INSERT INTO supervisors_select (supervisor_name, supervisor_code)
VALUES
    ('З****** О****** И******', '1'),
    ('С****** С****** А******', '2'),
    ('Д****** В****** Ю******', '3'),
    ('С****** В****** В******', '4'),
    ('И******Д****** И******', '5'),
    ('Г****** Р****** Ф******', '6'),
    ('А****** Э****** И******', '7'),
    ('З****** А****** Р******', '8'),
    ('З****** А****** Р******', '9'),
    ('Ф****** А****** Р******', '10'),
    ('М****** Д****** Ш******', '11'),
    ('Все', '12');

-- Добавляем в таблицу курсов указание года обучения (обязательно для развертывания)
INSERT INTO years_of_study (year_of_study)
VALUES
    ('1'),
    ('2'),
    ('3'),
    ('4');

-- Добавляем в таблицу наименований студенческих работ данные из формы
INSERT INTO studentsworkstable SET student_name=?, year_of_study=?, supervisor_name=?, work_name=?, user_id=?, work_file=? ON DUPLICATE KEY UPDATE student_name=?, year_of_study=?, supervisor_name=?, work_name=?, work_file=?;
-- Данные для подготовленного выражения: mysqli_stmt_bind_param($stmt, 'sissississs', $student_name, $year_of_study, $supervisor_name, $work_name, $user_id, $file_url, $student_name, $year_of_study, $supervisor_name, $work_name, $file_url);

-- Формируем запрос в БД с указанием выбранного научного руководителя с сортировкой по курсу обучения
SELECT student_name, year_of_study, supervisor_name, work_name FROM studentsworkstable WHERE supervisor_name='$supervisor_select' ORDER BY year_of_study, date_creation DESC;

-- Формируем запрос на получение всего списка наименований студенческих работ
SELECT student_name, year_of_study, supervisor_name, work_name FROM studentsworkstable ORDER BY year_of_study, date_creation DESC;

-- Формируем запрос на получение данных научных руководителей из БД
SELECT * FROM supervisor_cards;

-- Добавляем в таблицу пользователей данные при регистрации
INSERT INTO users SET user_surname='$user_surname', user_name='$user_name', user_last_name='$user_last_name', user_email='$user_email', user_password='$user_password';

-- Формируем запрос на получение данных пользователя
SELECT id, user_surname, user_name, user_last_name, user_email, user_password FROM users WHERE user_email='$user_email';

-- Формируем запрос на получение списка email зарегистрированных
SELECT user_email FROM users;

-- Добавляем данные администратора
INSERT INTO admins (admin_surname, admin_name, admin_password) VALUES ('admin', 'admin', '$2y$10$TjuX9jt8ASjfJQw.McrLauQo6qh88WppAps/Y5dvaSWrHTpJc8Z4e');

-- Формируем запрос на получение данных администратора
SELECT id, admin_surname, admin_name, admin_password FROM admins WHERE admin_name='$admin_login';

-- Формируем запрос в БД на получение информации о работах, а также ссылки на скачивание файла
SELECT student_name, year_of_study, supervisor_name, work_name, work_file, work_file FROM studentsworkstable WHERE supervisor_name='$supervisor_select' ORDER BY year_of_study;

-- Добавляем данные в БД для новой карточки научного руководителя
INSERT INTO supervisor_cards SET supervisor_name=?, supervisor_photo=?, supervisor_status=?, supervisor_interests=?, supervisor_site=?;
-- mysqli_stmt_bind_param($stmt, 'sssss', $supervisor_name, $file_url, $supervisor_status, $supervisor_interests, $supervisor_site);

-- Формируем запрос на удаление карточки научного руководителя из базы данных
DELETE FROM supervisor_cards WHERE supervisor_name = '$supervisor';