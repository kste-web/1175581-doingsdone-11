<tr class="tasks__item task 
<?php if($tasks[$index]['is_complete'] == true):?>
	<?php echo 'task--completed'; ?>
	<?php endif;?>">
	<td class="task__select">
		<label class="checkbox task__checkbox">
			<input class="checkbox__input visually-hidden" type="checkbox" checked>
			<span class="checkbox__text"><?=htmlspecialchars($task['task']);?></span>
		</label>
	</td>
	<td class="task__date"><?=$task['date'];?></td>
	<td class="task__controls"></td>
</tr>