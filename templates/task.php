<tr class="tasks__item task 
<?php
 if($task['is_complete'] == true):?>
	task--completed
<?php endif;?>
<?php
 if(count_the_time($task['date']) <= 24 && $task['date'] != null && $task['is_complete'] == false) :?>
	task--important	
<?php endif;?>
	">
	<td class="task__select">
		<label class="checkbox task__checkbox">
			<input class="checkbox__input visually-hidden" type="checkbox" checked>
			<span class="checkbox__text"><?=htmlspecialchars($task['task']);?></span>
		</label>
	</td>
	<td class="task__date"><?=$task['date'];?></td>
	<td class="task__controls"></td>
</tr>