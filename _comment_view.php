<?php
	// отображение одного комментария из объекта $comment
?>
<ul class='comment row'>
	<li class='comment author'>
		<p class='created_at'><?= $comment->created_at?></p>
		<p class='fio'><?= $comment->fio?></p>
		<p class='email'><?= $comment->email?></p>
	</li>
	<li class='comment text'>
		<p><?= $comment->text?></p>
	</li>
</ul>