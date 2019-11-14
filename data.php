<?php
// показывать или нет выполненные задачи
$show_complete_tasks = rand(0, 1);
$user_name = 'Карен Степанянц';
$projects = ['Входящие','Учеба','Работа','Домашние дела','Авто'];
$tasks = [
	[
		'task' => 'Собеседование в IT компании',
		'date' => '01.12.2019',
		'category' => 'Работа',
		'is_complete' => false
	],
	[
		'task' => 'Выполнить тестовое задание',
		'date' => '25.12.2019',
		'category' => 'Работа',
		'is_complete' => false
	],
	[
		'task' => 'Сделать задание первого раздела',
		'date' => '	21.12.2019',
		'category' => 'Учеба',
		'is_complete' => true
	],
	[
		'task' => 'Встреча с другом',
		'date' => '22.12.2019',
		'category' => 'Входящие',
		'is_complete' => false
	],
	[
		'task' => 'Купить корм для кота',
		'date' => null,
		'category' => 'Домашние дела',
		'is_complete' => false
	],
	[
		'task' => 'Заказать пиццу',
		'date' => null,
		'category' => 'Домашние дела',
		'is_complete' => false
	]
];
