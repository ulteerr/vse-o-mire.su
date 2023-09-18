<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $title; ?></title>
	<?= $script; ?>
</head>

<body>
	<header class="p-3 bg-dark text-white">
		<div class="container">
			<div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
				<ul class="nav">
					<li><a href="#" class="nav-link text-secondary">Главная</a></li>
					<li><a href="#" class="nav-link text-white">Функции</a></li>
					<li><a href="#" class="nav-link text-white">Ценообразование</a></li>
					<li><a href="#" class="nav-link text-white">FAQ</a></li>
					<li><a href="#" class="nav-link text-white">О нас</a></li>
				</ul>
				<div class="text-end">
					<button type="button" class="btn btn-outline-light me-2">Войти</button>
					<button type="button" class="btn btn-warning">Зарегистрироваться</button>
				</div>
			</div>
		</div>
	</header>
	<main>
		<div class="container">
			<?= $content ?>
		</div>
	</main>
	<footer>

	</footer>
</body>

</html>