<?php
// Считаем количество задач в проекте
function tasks_count ($array, $project_name) {
	$count = 0;
	for($i = 0; $i < count($array); $i++) {
		if($array[$i]['category'] == $project_name) {
			$count++;
		}
	}
	echo $count;
}

//Функция шаблонизатор
function include_template($name, array $data = []) {
    $name = 'templates/' . $name;
    $result = '';

    if (!is_readable($name)) {
        return $result;
    }

    ob_start();
    extract($data);
    require $name;

    $result = ob_get_clean();

    return $result;
}

//Считаем сколько часов осталось до дедлайна
function count_the_time ($task_date) {
   $current_time = time();
   $end_time = strtotime($task_date);
   $hours_to_end = ($end_time - $current_time)/3600;
   return floor($hours_to_end);
}