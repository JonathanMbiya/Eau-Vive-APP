<?php
require('system/dash.php');

$layout = new DASH(title: 'Factures');
?>

<div class="flex flex-col items-center gap-10 text-gray-700 dark:text-gray-300 w-full">
	<?php
	include("partials/pageheadermain.php");
	renderHeaderMain('Factures', 'Liste de toutes les factures', [
		'text' => '+ Nouveau',
		'href' => '/app/factures/nouveau'
	], [
		[
			'href' => '/app',
			'text' => 'Dashboard'
		],
		[
			'text' => 'Liste factures',
			'isActive' => true
		]
	]);
	?>
	<div class="mt-5 flex flex-col w-full">
		<?php
		include('partials/render/invoiceList.php');
		renderInvoiceList();
		?>
	</div>
</div>
