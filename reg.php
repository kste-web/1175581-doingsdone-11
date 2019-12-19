<?php
require_once('init.php');
require_once('functions.php');

$tpl_data = [];


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		// Копируем массив POST в $form
	$form = $_POST;
		//Создаем массив для хранения ошибок
	$errors = [];
		//Создаем массив с проверяемыми полями
	$req_fields = ['email', 'password', 'name'];
		//Перебираем его, и если поле пустое записываем ошибку в массив
	foreach ($req_fields as $field) {
		if (empty($form[$field])) {
			$errors[$field] = "Не заполнено поле " . $field;
		}
	}

		//Если нет ошибок связанных с пустыми полями
	if (empty($errors)) {
			//Получаем email
		$email = mysqli_real_escape_string($con, $form['email']);
			//Делаем запрос и проверяем есть ли в базе уже юзер с этим емэйлом
		$sql = "SELECT id FROM users WHERE email = '$email'";
			//Получаем результат
		$res = mysqli_query($con, $sql);
			//Если есть строка, записываем ошибку
		if(mysqli_num_rows($res) > 0) {
			$errors['email_exist'] = 'Пользователь с этим email уже зарегистрирован';
		}
			//Если нет, то добавляем пользователя
		else {
					//хэшируем пароль
			$password = password_hash($form['password'], PASSWORD_DEFAULT);
					//добавляем пользователя
			$sql = "INSERT INTO users (dt_add, email, name, password) VALUES (NOW(), ?, ?, ?)";
			$stmt = db_get_prepare_stmt($con, $sql, [$form['email'], $form['name'], $password]);
			$res = mysqli_stmt_execute($stmt);
		}
				//Если нет ошибок, переводим юзера на форму авторизации
		if ($res && empty($errors)) {
			header("location: enter.php");
			exit();
		}
				//записываем данные в массив и передаем в шаблон
		$tpl_data['errors'] = $errors;
		$tpl_data['values'] = $form;

	}
		//Если в массиве с есть ошибки связаные с пустыми полями
	else {
		$page_content = include_template('register.php', ['errors' => $errors]);
		print($page_content);
	}
}


$page_content = include_template('register.php', $tpl_data);
print($page_content);


?>