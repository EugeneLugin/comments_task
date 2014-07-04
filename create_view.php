// созадние нового комментария

// убираем старые ошибки
for (var errors = document.getElementsByClassName('error'); errors.length > 0; errors = document.getElementsByClassName('error')) {
	for (i = 0; i < errors.length; i++) {
		errors[i].remove();
	}
}
if (document.getElementsByClassName('succeed').length > 0) {
	document.getElementsByClassName('succeed')[0].remove();
}

// включаем кнопку "опубликовать"
var form = document.getElementById('<?= $_POST['form_id']?>');
var submit_button = form.elements[form.elements.length-1]
submit_button.disabled = false; submit_button.value='Опубликовать';

<?php 
// нет ошибок
if (empty($comment->errors)) { ?>
	// вывод комментария
	var newComment = document.createElement('div');
	newComment.innerHTML = decodeURIComponent('<?php ob_start(); include '_comment_view.php'; echo rawurlencode(ob_get_clean()); ?>');
	if (document.getElementById('comments').childNodes.length > 0) {
		document.getElementById('comments').insertBefore(newComment, document.getElementById('comments').childNodes[0]);
	} else {
		document.getElementById('comments').appendChild(newComment);
	}

	// сброс формы
	form.reset();
	
	// сообщение об успешности
	var succeed = document.createElement('div');
	succeed.className = "succeed";
	succeed.innerHTML = 'комментарий опубликован успешно';
	form.childNodes[1].appendChild(succeed);
	
	// через 3 секунды убираем вывод об успешности публикации
	setTimeout(function() {if (document.getElementsByClassName('succeed').length > 0) {
		document.getElementsByClassName('succeed')[0].remove();
	}}, 3000);
<?php } else {
// есть ошибки - вывод всех ошибок под полями ввода ?>
	<?php foreach(array_keys($comment->errors) as $error_field) { ?>		
		var tempError = document.createElement('div');
		tempError.className = "error";
		tempError.innerHTML = decodeURIComponent('<?= $comment->errors[$error_field];?>');
		document.getElementsByName('comment[<?= $error_field?>]')[0].parentNode.appendChild(tempError);
	<?php } ?>
<?php } ?>