<?php
require('system/dash.php');

$layout = new DASH(title: 'Liste users');
?>

<div class="flex flex-col items-center gap-10 text-gray-700 dark:text-gray-300 w-full">
	<?php
	include("partials/pageheadermain.php");
	renderHeaderMain('Users', 'Liste de tous les users', [
		'text' => '+ Nouveau',
		'href' => '/app/users/nouveau'
	], [
		[
			'href' => '/app',
			'text' => 'Dashboard'
		],
		[
			'text' => 'Liste users',
			'isActive' => true
		]
	]);
	?>
	<div class="mt-5 flex flex-col w-full">
		<?php
		include('partials/render/userList.php');
		renderUserList();
		?>
	</div>
</div>
