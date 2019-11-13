<?php
require_once('functions.php');
require_once('config.php');
require_once('data.php');

$content = include_template('main.php',
	[
		'tasks' => $tasks,
		'projects' => $projects,
		'show_complete_tasks' => $show_complete_tasks
	]);

$layout_content = include_template('layout.php', [
	'content' => $content,
	'title' => $config['title']
]);

print($layout_content);
?>