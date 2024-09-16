<?php
session_start();

class HTML
{
	public function __construct(public string $title, public string $lang = 'en')
	{
		ob_start();
	}

	public function __destruct()
	{
		$output = ob_get_clean();

		ob_start();
?>

		<!doctype html>
		<html lang="<?= $this->lang; ?>">

		<head>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<meta name="description" content="">
			<meta name="author" content="johnkat MJ">


			<style>
				.bd-placeholder-img {
					font-size: 1.125rem;
					text-anchor: middle;
					-webkit-user-select: none;
					-moz-user-select: none;
					user-select: none;
				}

				@media (min-width: 768px) {
					.bd-placeholder-img-lg {
						font-size: 3.5rem;
					}
				}
			</style>
			<title><?= $this->title; ?></title>

			<link href="/src/styles/global.scss" rel="stylesheet" />

		</head>

		<body class="min-h-dvh w-full bg-gray-50 dark:bg-gray-950">
			<?= $output; ?>
			<script src="/src/scripts/index.js" type="module"></script>
		</body>

		</html>
<?php
		die(ob_get_clean());
	}
}
