<?php
require('system/dash.php');

$layout = new DASH(title: 'Liste Produits');
?>

<div class="flex flex-col items-center gap-10 text-gray-700 dark:text-gray-300 w-full">
	<?php
	include("partials/pageheadermain.php");
	renderHeaderMain('Produits', 'Liste de tous les produits', [
		'text' => '+ Nouveau',
		'href' => '/app/produits/nouveau'
	], [
		[
			'href' => 'Dashboard',
			'text' => '/app'
		],
		[
			'text' => 'Liste Produits',
			'isActive' => true
		]
	]);
	?>
	<div class="mt-5 flex flex-col w-full">
		<?php
		include('partials/render/productList.php');
		renderProductList();
		?>
	</div>
</div>
