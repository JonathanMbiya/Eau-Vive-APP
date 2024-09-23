<?php
require('system/dash.php');

$layout = new DASH(title: 'Mouvement Stock');
?>

<div class="flex flex-col items-center gap-10 text-gray-700 dark:text-gray-300 w-full">
	<?php
	include("partials/pageheadermain.php");
	renderHeaderMain('Mouvement Stock', 'Liste de toutes les entrees', [
		'text' => '+ Nouveau',
		'href' => '/app/mouvement-stock/nouveau'
	], [
		[
			'href' => '/app',
			'text' => 'Dashboard'
		],
		[
			'text' => 'Liste Mouvement',
			'isActive' => true
		]
	]);
	?>
	<div class="mt-5 flex flex-col w-full">
		<?php
		include('partials/render/mvmStockLst.php');
		renderMouvementList("entree");
		?>
	</div>
</div>
