<?php
require_once('functions.php');
require_once('config.php');
require_once('data.php');
require_once('init.php');

	// Запрос на получение списка проектов
$sql = "SELECT name, id FROM projects WHERE user_id = 2";

$result = mysqli_query($con, $sql);

if(!$result) {
	$error = mysqli_error($con);
	$content = include_template('error.php', ['error' => $error]);
}

$projects = mysqli_fetch_all($result, MYSQLI_ASSOC);

	// Запрос на получение списка задач
$sql = "SELECT name, status, dt_do FROM tasks WHERE user_id = 2";

$result = mysqli_query($con, $sql);

if(!$result) {
	$error = mysqli_error($con);
	$content = include_template('error.php', ['error' => $error]);
}

$tasks = mysqli_fetch_all($result, MYSQLI_ASSOC);

	//параметры запроса (id проекта)
if (isset($_GET['project_id'])) {

	$project_id = $_GET['project_id'];

	$sql = "SELECT * FROM tasks WHERE user_id = 2 && project_id = '" .$project_id. "'";

	$result = mysqli_query($con, $sql);

	if(!$result) {
		$error = mysqli_error($con);
		$content = include_template('error.php', ['error' => $error]);
	}

	$pr_tasks = mysqli_fetch_all($result, MYSQLI_ASSOC);
	$tasks = $pr_tasks;

}

else {
	http_response_code(404);
}


$content = include_template('main.php',
	[
		'tasks' => $tasks,
		'projects' => $projects,
		'show_complete_tasks' => $show_complete_tasks,
		'project_id' => $project_id
	]);

$layout_content = include_template('layout.php', [
	'content' => $content,
	'title' => $config['title'],
	'user_name' => $user_name
]);

print($layout_content);
?>
