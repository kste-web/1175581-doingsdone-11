<?php
require_once('init.php');
require_once('functions.php');

		//Если форма отправлена методом POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {	
			//Копируем массив POST d $form
	$form = $_POST;
	//Сщздаем массив с проверяемыми полями
	$required = ['email', 'password'];
	//Создаем массив с ошибками
	$errors = [];
	//Перебираем массив с проверяемыми полями
	foreach ($required as $field) {
		//Если поле пустое добавляем ошибку в масиив $errors
		if (empty($form[$field])) {
			$errors[$field] = 'Это поле надо заполнить';
		}
	}
	//Если есть незаполненые поля, возвращаем шаблон
	if (count($errors)) {
		$page_content = include_template('form-authorization.php', ['form' => $form, 'errors' => $errors]);
		print($page_content);
	}
    //Записываем email пользователя в  $email
	$email = mysqli_real_escape_string($con, $form['email']);
	//Отправляем запрос на получение всех данных юзера по введенному им email
	$sql = "SELECT * FROM users WHERE email = '$email'";
	//Получаем результат
	$res = mysqli_query($con, $sql);
	//Если получили, преобразуем в массив и сохраняем в $user, если нет то записываем в $user - null
	$user = $res ? mysqli_fetch_array($res, MYSQLI_ASSOC) : null;
	//Если ошибок нету и user = true
	if (!count($errors) and $user) 	{
		//Если пароль введенный юзером совпадает с паролем из бд
		if (password_verify($form['password'], $user['password'])) {
			//Создаем сессию и записываем в нее все данные юзера
			$_SESSION['user'] = $user;
		}
		//если пароли не совпадают, добавляем ошибку
		else {
			$errors['password'] = 'Неверный пароль';
		}
	}
	//Если ошибки есть, такого пользователя не существует
	else {
		$errors['email_exist'] = 'Такой пользователь не найден';
	}
	//создаем шаблон и передаем туда данные из формы и массив с ошибками
	if (count($errors)) {
		$page_content = include_template('form-authorization.php', ['form' => $form, 'errors' => $errors]);
		print($page_content);
	}
	//Если ошибок нет, то пользователь прошел аутентификацию, перенаправляем на главную
	else {
		header("Location: index.php");
		exit();
	}
}

else {
	$page_content = include_template('form-authorization.php',[]);
		print($page_content);
}

?>
