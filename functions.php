<?php

function tasks_count ($array, $project_name) {
	$count = 0;
	for($i = 0; $i < count($array); $i++) {
		if($array[$i]['category'] == $project_name) {
			$count++;
		}
	}
	echo $count;
}


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