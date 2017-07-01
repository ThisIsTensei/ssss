<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link  rel="stylesheet" type="text/css" href="tasks.css">
	<link  rel="stylesheet" type="text/css" href="modal.css">
	<script src="http://code.jquery.com/jquery-2.0.2.min.js"></script>
	<script src="script.js"></script>
</head>
<?php ?>
<body>
	<div class="top-menu">
		<div class="top-menu__button">
			<a href="projects.php" class="top-menu__button_in">Проекты</a>
		</div>
		<div class="top-menu__button active">
			<a href="tasks.php" class="top-menu__button_in">Задачи</a>
		</div>
	</div>
	<div class="main-frame">
		<div class="clearfix">
			<div class="main-frame__title fl">Задачи</div>
			<div class="project-ref fl">
				<?php
					if (isset($_GET["key"])) {
						echo '
							в проекте
							<a href="tasks.php" class="project__ref_blue">
								проект '. $_GET["key"] .'
							</a>
						';
					}
					echo '
							</div>
						</div>
						<div class="titles clearfix">';
							if (isset($_GET["sort"]) and ($_GET["sort"] == 'asc')) {
								echo '<a class="titles__task-name fl" href="tasks.php?sort=desc&sort-field=project">Ключ</a>';
							} else {
								echo '<a class="titles__task-name fl" href="tasks.php?sort=asc&sort-field=project">Ключ</a>';
							}
							if (isset($_GET["sort"]) and ($_GET["sort"] == 'asc')) {
								echo '<a class="titles__task-new fl" href="tasks.php?sort=desc&sort-field=status">Статус</a>';
							} else {
								echo '<a class="titles__task-new fl" href="tasks.php?sort=asc&sort-field=status">Статус</a>';
							}
							if (isset($_GET["sort"]) and ($_GET["sort"] == 'asc')) {
								echo '<a class="titles__task-key fl" href="tasks.php?sort=desc&sort-field=task">Задача</a>';
							} else {
								echo '<a class="titles__task-key fl" href="tasks.php?sort=asc&sort-field=task">Задача</a>';
							}
							if (isset($_GET["sort"]) and ($_GET["sort"] == 'asc')) {
								echo '<a class="titles__task-deskr fl" href="tasks.php?sort=desc&sort-field=description">Описание</a>';
							} else {
								echo '<a class="titles__task-deskr fl" href="tasks.php?sort=asc&sort-field=description">Описание</a>';
							}
					echo '</div>';
			$tasks = ["1" => ["project" => "PRG-2", "status" => "new", "task" => "Задача 1", "deskr" => "небольшая часть описания задачи небольшая часть описания задачи"],
						"2" => ["project" => "PRG-1", "status" => "new", "task" => "Задача 2", "deskr" => "небольшая часть описания задачи небольшая часть описания задачи"],
						"3" => ["project" => "PRG-1", "status" => "new", "task" => "Задача 3", "deskr" => "небольшая часть описания задачи небольшая часть описания задачи"],
						"4" => ["project" => "PRG-3", "status" => "new", "task" => "Задача 4", "deskr" => "небольшая часть описания задачи небольшая часть описания задачи"]
					];
			function endKey($array){
				end($array);
				return key($array);
			}
			function array_msort($array, $cols)
			{
				$colarr = array();
				foreach ($cols as $col => $order) {
					$colarr[$col] = array();
					foreach ($array as $k => $row) { $colarr[$col]['_'.$k] = strtolower($row[$col]); }
				}
				$eval = 'array_multisort(';
				foreach ($cols as $col => $order) {
					$eval .= '$colarr[\''.$col.'\'],'.$order.',';
				}
				$eval = substr($eval,0,-1).');';
				eval($eval);
				$ret = array();
				foreach ($colarr as $col => $arr) {
					foreach ($arr as $k => $v) {
						$k = substr($k,1);
						if (!isset($ret[$k])) $ret[$k] = $array[$k];
						$ret[$k][$col] = $array[$k][$col];
					}
				}
				return $ret;

			}

			$sort_field = isset($_GET["sort_field"]) ? $_GET["sort_field"] : 'key';
			echo '<pre>';
					var_dump($tasks);
			if (isset($_GET["sort"]) and ($_GET["sort"] == 'desc')) {
				$tasks = array_msort($tasks, array($sort_field => SORT_DESC), SORT_NATURAL);
			} else {
				$tasks = array_msort($tasks, array($sort_field => SORT_ASC), SORT_NATURAL);
			}
			foreach ($tasks as $key => $value) {
				if ($key == 1) {
					echo '<div class="task first clearfix">';
				} elseif ($key == endKey($tasks)) {
					echo '<div class="task last clearfix">';
				} else {
					echo '<div class="task clearfix">';
				}
				echo '
						<div class="task__drag"></div>
						<div class="task__name">
							<a href="javascript:TaskDetail()" class="task__name_ref-blue">'.$tasks[$key]["project"].'</a>
						</div>
						<div class="task__new fl">
							'.$tasks[$key]["status"].'
						</div>
						<div class="task__key">'.$tasks[$key]["task"].'</div>
						<div class="task__deskr fl">'.$tasks[$key]["deskr"].'</div>
						<div class="task__arrow-ref">
							<a class="task__arrow-ref_in" href="javascript:TaskDetail()">подробнее</a>
						</div>
					</div>
				';
			}
			unset($value);
			echo '
				<div class="clearfix">
					<a class="add-cont fl" href="javascript:AddTask()">+ добавить</a>
					<div class="tasks-count">Всего задач: '.count($tasks).'</div>
				</div>
			';
		?>
		<!--<div class="task bord-none clearfix">
			<div class="task__drag"></div>
			<div class="task__name">
				<a href="javascript:TaskDetail()" class="task__name_ref-blue">PRG-1</a>
			</div>
			<div class="task__work fl">
				working
			</div>
			<div class="task__key">Задача 2</div>
			<div class="task__deskr fl">небольшая часть описания задачи небольшая часть описания задачи</div>
			<div class="task__arrow-ref">
				<a class="task__arrow-ref_in" href="javascript:TaskDetail()">подробнее</a>
			</div>
		</div>-->
	</div>
	<div class="add-task blackout" style="display: none;">
		<div class="modal">
			<div class="clearfix">
				<div class="modal__title">Новая задача</div>
				<a class="modal__btn-close" href="javascript:ModalHide()"></a>
			</div>
			<form name="add_project_form" class="clearfix" method="post" action="input1.php">
				<span class="field_title">Название:</span>
				<input type="text" required class="field">
				<span class="field_title">Статус:</span>
				<select required class="field_select">
					<option value="новая">новая</option>
					<option value="в работе">в работе</option>
					<option value="выполнена">выполнена</option>
				</select>
				<span class="field_title">Тип задачи:</span>
				<select required class="field_select">
					<option value="задача">задача</option>
					<option value="улучшение">улучшение</option>
					<option value="баг">баг</option>
				</select>
				<span class="field_title">Описание:</span>
				<textarea rows="4" class="field" style="height: auto;"></textarea>
				<input type="submit" value="Создать" class="modal-submit">
			</form>
		</div>
	</div>
	<div class="task-detail blackout" style="display: none;">
		<div class="modal">
			<div class="clearfix">
				<div class="modal__title">Редактирование задачи</div>
				<a class="modal__btn-close" href="javascript:ModalHide()"></a>
			</div>
			<form name="add_project_form" class="clearfix" method="post" action="input1.php">
				<span class="field_title">Название:</span>
				<input type="text" required class="field">
				<span class="field_title">Статус:</span>
				<select required class="field_select">
					<option value="новая">новая</option>
					<option value="в работе">в работе</option>
					<option value="выполнена">выполнена</option>
				</select>
				<span class="field_title">Тип задачи:</span>
				<select required class="field_select">
					<option value="задача">задача</option>
					<option value="улучшение">улучшение</option>
					<option value="баг">баг</option>
				</select>
				<span class="field_title">Описание:</span>
				<textarea rows="4" class="field" style="height: auto;"></textarea>
				<input type="submit" value="Сохранить" class="modal-submit">
			</form>
		</div>
	</div>
</body>