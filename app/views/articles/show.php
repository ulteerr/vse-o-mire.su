<div class="container mt-5">

	<h1><?= $article['title'] ?></h1>
	<p><?= $article['content'] ?></p>
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
		<h2>Комментарии</h2>
		<?php foreach ($comments as $comment) : ?>
			<div class="comment">
				<div class="comment-header">
					<img src="user_avatar.jpg" alt="User Avatar" class="avatar">
					<h5 class="user-name"><?= $comment['user']['username'] ?></h5>
					<span class="comment-date">Дата публикации</span>
				</div>
				<div class="comment-content">
					<p><?= $comment['content'] ?></p>
				</div>
				<?php if (count($comment['replies']) < 10) : ?>
					<button class="btn btn-primary reply-btn">Ответить</button>
				<?php endif ?>
			</div>
			<?php foreach ($comment['replies'] as $reply) : ?>
				<div class="comment reply-comment">
					<div class="comment-header">
						<img src="user_avatar.jpg" alt="User Avatar" class="avatar">
						<h5 class="user-name"><?= $reply['user']['username'] ?></h5>
						<span class="comment-date">Дата публикации</span>
					</div>
					<div class="comment-content">
						<p><?= $reply['content'] ?></p>
					</div>
				</div>
			<?php endforeach ?>
		<?php endforeach ?>
		<?= $pagination->generateLinks() ?>
	</div>