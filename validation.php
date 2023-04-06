<?php

// if (count($_POST) > 0) {
//     if (strlen($_POST['student_name']) === 0) {
//         echo "Укажите Фамилию Имя Отчество<br>";
//     };
// }; 

// // Проверка заполненности 
// // @param string $student_name поле для указания ФИО
// function validate_name($student_name) {
//     if (empty($student_name)) {
//         return "Это поле должно быть заполнено";
//     };
// };

// // Проверка заполненности 
// // @param string $work_name поле для указания наименования научной работы
// function validate_textarea($work_name) {
//     if (empty($work_name)) {
//         return "Это поле должно быть заполнено";
//     };
// };

// $rules = [
//     'student_name' => function() {
//         return validate_name('student_name');
//     },
//     'work_name' => function() {
//         return validate_textarea('work_name')
//     }
// ];

// foreach ($_POST as $key => $value) {
//     if (isset($rules[$key])) {
//         $rule = $rules[$key];
//         $errors[$key] = $rule();
//     }
// };

// $errors = array_filter($errors);