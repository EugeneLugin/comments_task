<?php 
	// список комментариев и форма ввода нового комментария
?>
<!DOCTYPE html>	
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Комментарии</title>

<script src='index.js'></script>
<link rel="stylesheet" type="text/css" href="index.css">

</head>
<body>

<h3>Комментарии</h3>
<div id='comments' class='comments list'>
<?php

foreach ($comments as $comment) {
	include '_comment_view.php'; // выводим блок для каждого комментария
}
?>
</div> 

<h3>Добавить комментарий</h3>
<form id='new_comment' action="/" method="post" onsubmit="event.preventDefault(); return submit_remote(this)">
	<ul class='comment row'>
		<li class='comment author'>
			<p class='fio'><input type='text' name='comment[fio]' placeholder='ФИО'></p>
			<p class='email'><input type='text' name='comment[email]' placeholder='Email'></p>			
		</li>
		<li class='comment text'>
			<p><textarea name='comment[text]' placeholder='Комментарий'></textarea></p>
		</li>
		<li class='comment button'><input type='submit' value='Опубликовать'></li>
	</ul>	
	
</form>

</body>
</html>