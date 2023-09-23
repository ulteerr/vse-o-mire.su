<div class="container mt-5">

	<h1><?= $article['title'] ?></h1>
	<p><?= $article['content'] ?></p>

	<!-- Форма для добавления комментариев -->
	<form id="commentForm">
		<div class="mb-3">
			<label for="commentName" class="form-label">Имя</label>
			<input type="text" class="form-control" id="commentName" required>
		</div>
		<div class="mb-3">
			<label for="commentText" class="form-label">Комментарий</label>
			<textarea class="form-control" id="commentText" rows="4" required></textarea>
		</div>
		<button type="submit" class="btn btn-primary">Оставить комментарий</button>
	</form>

	<div class="container">
		<h3>Комментарии</h3>
		<div class="comment">
			<div class="comment-header">
				<img src="user_avatar.jpg" alt="User Avatar" class="avatar">
				<h5 class="user-name">Имя пользователя</h5>
				<span class="comment-date">Дата публикации</span>
			</div>
			<div class="comment-content">
				<p>Содержание комментария</p>
			</div>
			<button class="btn btn-primary reply-btn">Ответить</button>
		</div>
		<div class="comment reply-comment">
			<div class="comment-header">
				<img src="user_avatar.jpg" alt="User Avatar" class="avatar">
				<h5 class="user-name">Имя пользователя</h5>
				<span class="comment-date">Дата публикации</span>
			</div>
			<div class="comment-content">
				<p>Содержание вложенного комментария</p>
			</div>
			<button class="btn btn-primary reply-btn">Ответить</button>
		</div>
		<?php include_view('includes.pagination', ['breadcrumbs' => 1]);?>
	</div>