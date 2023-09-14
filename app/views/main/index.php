<p>Главная страница</p>
<?php foreach ($articles as $article) : ?>
	<p><?= $article['content'] ?></p>
<?php endforeach ?>