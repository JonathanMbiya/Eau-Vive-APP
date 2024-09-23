<?php
require('system/dash.php');
require_once('controllers/inventaireCtrl.php');


$layout = new DASH(title: 'Details Inventaire');
if (isset($_GET['id'])) {
	$invoiceId = $_GET['id'];
	$invoiceOp = new InventaireController();
	$invoice = $invoiceOp->GetInventaire($invoiceId);

	if (!empty($invoice)) {
		$invoiceRows = [];
?>

		<div class="flex flex-col items-center gap-10 text-gray-700 dark:text-gray-300 w-full">
			<?php
			include("partials/page-action-header.php");
			renderHeader(
				"Details Inventaire du : " . $invoice['dateInventaire'],
				"Detail Inventaire | Par : " . $invoice['userName'],
				[
					[
						'text' => 'Dashboard',
						'href' => '/app'
					],
					[
						'text' => 'Inventaires',
						'href' => '/app/inventaires/'
					],
					[
						'text' => 'Details',
						'isActive' => true
					]
				]
			);
			?>
			<div class="mb-20 mt-4 flex flex-col w-full container mx-auto xl:max-w-7xl">
				<div class="w-full p-6 md:p-10 rounded-lg dark:bg-gray-950 border border-gray-200 dark:border-gray-900">
					<div class="w-full max-w-4xl mx-auto">
						<!-- <div class="flex justify-end gap-x-3 mb-6">
							<button class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none" href="#">
								<svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
									<polyline points="6 9 6 2 18 2 18 9" />
									<path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2" />
									<rect width="12" height="8" x="6" y="14" />
								</svg>
								Imprimer
							</button>
						</div> -->
						<div data-to-print class="">
							<div class="flex flex-col p-4 sm:p-10">
								<?php
								include("partials/render/inventaireListRows.php");
								renderInventaireRowList($invoiceId);
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php
	} else {
		include("partials/renderEmptyState.php");
		renderEmptyState(
			"Oops, aucune information dans la Base de donnees",
			"Un petit soucis quoi",
			[
				'text' => 'Liste Factures',
				'href' => '/app/factures/'
			]
		);
	}
} else {
	include("partials/renderEmptyState.php");
	renderEmptyState(
		'Vous etes sur une mauvaise page',
		'Retourner sur terre',
		[
			'text' => 'Dashboard',
			'href' => '/app'
		]
	);
}
?>
