	<section class="content__side">
		<h2 class="content__side-heading">Проекты</h2>
		<nav class="main-navigation">
			<ul class="main-navigation__list">
				<?php foreach($projects as $project):?>
				<li class="main-navigation__list-item
				<?php if($project['id'] == $project_id): ?>
					main-navigation__list-item--active
				<?php endif; ?>
				">
					<a class="main-navigation__list-item-link" href="http://localhost/1175581-doingsdone-11/index.php?<?php echo('project_id=' . $project['id']);?>"><?=htmlspecialchars($project['name']);?></a>
					<span class="main-navigation__list-item-count"><?php tasks_count($tasks, $project['id']);?></span>
				</li>
				<?php endforeach;?>
			</ul>
		</nav>
		<a class="button button--transparent button--plus content__side-button"
		href="pages/form-project.html" target="project_add">Добавить проект</a>
	</section>

	<main class="content__main">
		<h2 class="content__main-heading">Список задач</h2>

		<form class="search-form" action="index.php" method="get" autocompletse="off">
			<input class="search-form__input" type="text" name="q" value="" placeholder="Поиск по задачам">

			<input class="search-form__submit" type="submit" name="" value="Искать">
		</form>

		<div class="tasks-controls">
			<nav class="tasks-switch">
				<a href="/" class="tasks-switch__item tasks-switch__item--active">Все задачи</a>
				<a href="/" class="tasks-switch__item">Повестка дня</a>
				<a href="/" class="tasks-switch__item">Завтра</a>
				<a href="/" class="tasks-switch__item">Просроченные</a>
			</nav>

			<label class="checkbox">
				<!--добавить сюда атрибут "checked", если переменная $show_complete_tasks равна единице-->
				<input class="checkbox__input visually-hidden show_completed" type="checkbox" <?php if($show_complete_tasks == 1): ?> checked <?php endif; ?>>
				<span class="checkbox__text">Показывать выполненные</span>
			</label>
		</div>

		<table class="tasks">
			<?php if(empty($tasks) && $search == true) :?>
				<p>Ничего не найдено</p>
			<?php endif;?>
			<?php foreach($tasks as $task):?>
			<?php if($task['is_complete'] == true && $show_complete_tasks ==0 ):?>
				<?php  continue;?>
			<?php endif;?>
				<?=include_template('task.php', ['task' => $task, 'tt' => $tt]); ?>
			<?php endforeach;?>
		</table>
	</main>
