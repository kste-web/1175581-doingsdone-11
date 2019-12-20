<tr class="tasks__item task 
<?php
 if($task['status'] == true):?>
	task--completed
<?php endif;?>
<?php
 if(count_the_time($task['dt_do']) <= 24 && $task['dt_do'] != null && $task['status'] == false) :?>
	task--important	
<?php endif;?>
	">
	<td class="task__select">
		<label class="checkbox task__checkbox">
			<input class="checkbox__input visually-hidden" type="checkbox" checked>
			<span class="checkbox__text"><?=htmlspecialchars($task['name']);?></span>
		</label>
	</td>
	<td class="task__date"><?=$task['dt_do'];?></td>
	<td class="task__controls"></td>
</tr>
