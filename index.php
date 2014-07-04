<?php	
	header('Content-Type: text/html; charset=utf-8');

	include 'db.php'; // Соединение с базой
	include 'comment.php'; // Модель Комментарий и её контроллер
	$comments_controller = new CommentsController();
	
	// маршрутизация
	if($_SERVER['REQUEST_METHOD'] == 'GET') { 	
		$comments_controller->index(); // вызов экшена: список комментариев
	}
	else if($_SERVER['REQUEST_METHOD'] == 'POST') { // получены данные формы
		$comments_controller->create(); // вызов экшена: создание комментария
	}
?>
