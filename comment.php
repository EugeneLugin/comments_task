<?php

// Модель Комментарий

class Comment {
	var $fio, $email, $text, $created_at;	// имена свойств объекта совпадают с именами полей в таблице базы
	var $errors; // ошибки сохранения
	
	function __construct() {
		if (func_num_args() == 1) {
			$params = func_get_arg(0);
			
			$this->fio = $params['fio'];
			$this->email = $params['email'];
			$this->text = $params['text'];
		}
		$this->errors = array();
	}
	
	function validate() {
		$this->errors = array();
		if (empty($this->fio)) {
			$this->errors['fio'] = 'укажите ФИО';
		}
		if (empty($this->email)) {
			$this->errors['email'] = 'укажите Email';
		}
		if (empty($this->text)) {
			$this->errors['text'] = 'напишите комментарий';
		}
		if (strlen($this->fio) > 50) {
			$this->errors['fio'] = 'длинное ФИО (сократите до 50 символов)';
		}		
		if (strlen($this->email) > 50) {
			$this->errors['email'] = 'длинный email (максимум - 50 символов)';
		}
		if (strlen($this->text) > 500) {
			$this->errors['text'] = 'длинный комментарий (сократите до 500 символов)';
		}
		if (!empty($this->email) && strlen($this->email) <= 50 && !filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
			$this->errors['email'] = 'некорректный email';
		}
		return empty($this->errors);
	}
	
	function save() {
		global $db;
		
		if ($this->validate()) {
			$new_comment = $db->prepare("INSERT IGNORE INTO comment(fio, email, text) VALUES (:fio, :email, :text)");
			$new_comment->execute(array(
				':fio' => $this->fio,
				':email' => $this->email,
				':text' => $this->text));
			
			$new_comment = $db->prepare("SELECT MAX(created_at) as created_at FROM comment WHERE fio=:fio AND email=:email AND text=:text");
			$new_comment->execute(array(
				':fio' => $this->fio,
				':email' => $this->email,
				':text' => $this->text));
			$new_comment = $new_comment->fetch();
			
			$this->created_at = $new_comment['created_at'];			
			return true;
		}
		
		return false;
	}
}

// Контроллер комментариев

class CommentsController {

	function index() {
		global $db;
		
		$comments = $db->prepare("SELECT * FROM comment ORDER BY created_at DESC");
		$comments->execute();
		$comments->setFetchMode(PDO::FETCH_CLASS, 'Comment'); // будем получать объекты Comment с заполненными свойствами
		
		include 'index_view.php'; // представление списка комментариев
	}
	
	function new_one() {
	}
	
	function create() {
		$comment = new Comment($_POST['comment']);
		$comment->save();
		
		include 'create_view.php';
	}
}