<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link  rel="stylesheet" type="text/css" href="projects.css">
	<link  rel="stylesheet" type="text/css" href="modal.css">
	<script src="http://code.jquery.com/jquery-2.0.2.min.js"></script>
	<script src="script.js"></script>
</head>
<body>
	<div class="top-menu">
		<div class="top-menu__button active">
			<a href="projects.php" class="top-menu__button_in">Проекты</a>
		</div>
		<div class="top-menu__button">
			<a href="tasks.php" class="top-menu__button_in">Задачи</a>
		</div>
	</div>
	<div class="main-frame">
		<div class="main-frame__title fl">Проекты</div>	
		<?php
			$counter = 0;
			try {
				include "projects_add.php";
				$first = true;
				foreach(connections()->query('SELECT * from projs') as $row) {
					if ($first) {
						echo '<div class="project clearfix">';
						$first = false;
					} else {
						echo '<div class="project not_first clearfix">';
					}
					echo '
							<div class="project__name">
								<a href="tasks.php" class="project__ref_blue">'.$row['name_project'].'</a>
							</div>
							<div class="project__key">
								'.$row['key_project'].'
							</div>
							<div class="project__arrow-ref">
								<a href="tasks.php?key='.$row['id_project'].'" class="project__arrow-ref_in">Задачи</a>
							</div>
						</div>
					';
					$counter++;
				}
			$dbh = null;
			} catch (PDOException $e) {
				print "Error!: " . $e->getMessage() . "<br/>";
				die();
			}
			unset($value);
			echo '
				<div class="clearfix">
					<a class="add-cont fl" href="javascript:AddProject()">+ добавить</a>
					<div class="projects-count">Всего проектов: '.$counter.'</div>
				</div>
			';
		?>
			
	</div>
	<div class="add-project blackout" style="display: none;">
		<div class="modal">
			<div class="clearfix">
				<div class="modal__title">Новый проект</div>
				<a class="modal__btn-close" href="javascript:ModalHide()"></a>
			</div>
			<form name="add_project_form" class="clearfix" method="post" action="projects_add.php">
				<span class="field_title">Название:</span>
				<input type="text" name="name_project" class="field">
				<span class="field_title">Ключ:</span>
				<input type="text" name="key_project" class="field">
				<input name="button" type="submit" value="Создать" class="modal-submit" onclick="add_proj">
			</form>
		</div>
	</div>
</body>