<?php
require('system/dash.php');

$layout = new DASH(title: 'Liste Produits');
?>

<div class="flex flex-col items-center gap-10 text-gray-700 dark:text-gray-300 w-full">
	<?php
	include("partials/pageheadermain.php");
	renderHeaderMain('Rapport', 'Rapport financier', [
		'text' => '+ Nouveau',
		'href' => '/app/rapport/nouveau'
	], [
		[
			'href' => '/app',
			'text' => 'Dashboard'
		],
		[
			'text' => 'Rapport financier',
			'isActive' => true
		]
	]);
	?>
	<div class="mt-5 flex flex-col w-full">
		<?php
		include('partials/render/rapportList.php');
		renderRappoList();
		?>
	</div>
</div>
