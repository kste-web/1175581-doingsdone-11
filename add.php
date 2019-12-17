<?php
require_once('functions.php');
require_once('config.php');
require_once('data.php');
require_once('init.php');

$sql = "SELECT name, id FROM projects WHERE user_id = 2";
$result = mysqli_query($con, $sql);

if ($result) {
	$projects = mysqli_fetch_all($result, MYSQLI_ASSOC);
	$projects_ids = array_column($projects, 'id');
}
else {
	$error = mysqli_error($con);
	show_error($content, $error);
}


$content = include_template('form-task.php', 
	['projects' => $projects,
	'title'    => $config['title']
]);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		//Валидация формы

		// Проверяемые поля
	$required = ['name', 'project'];
		// Массив ошибок
	$errors = [];
		//Функции для проверки полей
	$rules = [
		'name' => function($value) {
			return validateLength($value, 10, 50);
		},
		'project' => function($value) use ($projects_ids) {
			return validateProject($value, $projects_ids);
		}

	];
    	//Получаем значения полей отправленных из формы и сохраняем их в ассоциативный массив $task
	$task = filter_input_array(INPUT_POST, ['name' => FILTER_DEFAULT, 'project' => FILTER_DEFAULT, 'date' =>FILTER_DEFAULT], true);
        //Перебираем массив $task и записываем ошибки в массив $errors
	foreach ($task as $key => $value) {
		if (isset($rules[$key])) {
			$rule = $rules[$key];
			$errors[$key] = $rule($value);
		}
        // Если поле есть в списке проверяемых и оно пустое добавляем ошибку
		if (in_array($key, $required) && empty($value)) {
			$errors[$key] = "Поле $key надо заполнить";
		}
	}
    	//Проверяем правильность заполнения даты
	if(!is_date_valid($_POST['date']) && !empty($_POST['date'])) {
		$errors['date'] = "неправильный формат даты";
	}
	else if(empty($_POST['date'])) {
		$_POST['date'] = null;
	}

    	//Фильтруем массив ошибок
	$errors = array_filter($errors);    	
    	//Если массив с ошибками содержит ошибки, подключаем шаблон, куда передаем массив с ошибками
	if (count($errors)) {
		$content = include_template('form-task.php', ['task' => $task, 'errors' => $errors, 'projects' => $projects]);
	}
		//Если ошибок нету, то отправляем форму
	else {
		//Отправка формы
		$task = $_POST;
		//Если добавили файл, записываем имя файла и путь к нему
	if (!empty($_FILES['file']['name'])) {
		$tmp_name = $_FILES['file']['tmp_name'];
		$filename = $_FILES['file']['name'];
		$task['file'] = $filename;
		move_uploaded_file($tmp_name,  $filename);
	}
	else {
		$task['file'] = null;
	}

		$sql = "INSERT INTO tasks (name, project_id, dt_do, user_id, status, dt_add, file) VALUES (?, ?, ?, 2, 0, NOW(), ?)";

		$stmt = db_get_prepare_stmt($con, $sql, $task);
		$res = mysqli_stmt_execute($stmt);

		if ($res) {
			header("Location: index.php");
		}
	}

}


print($content);
?>