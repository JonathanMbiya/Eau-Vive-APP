<?php
require('system/dash.php');
require_once('controllers/invoiceCtrl.php');


$layout = new DASH(title: 'Apercu Impression Page');
if (isset($_GET['id'])) {
	$invoiceId = $_GET['id'];
	$invoiceOp = new FactureController();
	$invoice = $invoiceOp->GetFacture($invoiceId);

	if (!empty($invoice)) {
		$invoiceRows = [];
?>

		<div class="flex flex-col items-center gap-10 text-gray-700 dark:text-gray-300 w-full">
			<?php
			include("partials/page-action-header.php");
			renderHeader(
				"Imprimer facture",
				"Apercu impression Facture #" . $invoice['id'],
				[
					[
						'text' => 'Dashboard',
						'href' => '/app'
					],
					[
						'text' => 'Liste Factures',
						'href' => '/app/factures/'
					],
					[
						'text' => 'Impression',
						'isActive' => true
					]
				]
			);
			?>
			<div class="mb-20 mt-4 flex flex-col w-full container mx-auto xl:max-w-7xl">
				<div class="w-full p-6 md:p-10 rounded-lg dark:bg-gray-950 border border-gray-200 dark:border-gray-900">
					<div class="w-full max-w-3xl mx-auto">
						<div class="flex justify-end gap-x-3 mb-6">
							<button class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none" href="#">
								<svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
									<polyline points="6 9 6 2 18 2 18 9" />
									<path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2" />
									<rect width="12" height="8" x="6" y="14" />
								</svg>
								Imprimer
							</button>
						</div>
						<div data-to-print class="bg-white rounded-lg dark:bg-gray-900/40">
							<div class="flex flex-col p-4 sm:p-10">
								<div class="flex justify-between">
									<div></div>
									<div class="text-end">
										<h2 class="text-2xl md:text-3xl font-semibold text-gray-800 dark:text-gray-200">
											Invoice #<?= $invoice["id"] ?>
										</h2>

										<address class="mt-4 not-italic text-gray-800 dark:text-gray-200">
											C/Lubumbashi<br>
											Lubumbashi DRC<br>
										</address>
									</div>
								</div>
								<div class="mt-8 grid sm:grid-cols-2 gap-3">
									<div>

									</div>
									<div class="sm:text-end space-y-2">
										<div class="grid grid-cols-2 sm:grid-cols-1 gap-3 sm:gap-2">
											<dl class="grid sm:grid-cols-5 gap-x-3">
												<dt class="col-span-3 font-semibold text-gray-800 dark:text-gray-200">Date facture:</dt>
												<dd class="col-span-2 text-gray-500 dark:text-gray-500">
													<?= $invoice["dateFacture"] ?>
												</dd>
											</dl>
										</div>
									</div>
								</div>


								<?php
								include("partials/render/invoiceListRows.php");
								renderInvoiceRowList($invoiceId);
								?>


								<div class="mt-8 flex sm:justify-end">
									<div class="w-full max-w-2xl sm:text-end space-y-2">
										<div class="grid grid-cols-2 sm:grid-cols-1 gap-3 sm:gap-2">
											<dl class="grid sm:grid-cols-5 gap-x-3">
												<dt class="col-span-3 font-semibold text-gray-800 dark:text-gray-200">Total:</dt>
												<dd class="col-span-2 text-gray-500 dark:text-gray-500"><?= $invoice["montantTotal"] ?></dd>
											</dl>
										</div>
									</div>
								</div>

								<div class="mt-8 sm:mt-12">
									<h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Merci!</h4>
									<p class="text-gray-500 dark:text-gray-500">Pour tout souci, n'hesitez pas de nous contacter :</p>
									<div class="mt-2">
										<p class="block text-sm font-medium text-gray-800 dark:text-gray-200">mail@roy.com</p>
										<p class="block text-sm font-medium text-gray-800 dark:text-gray-200">+243 97 24 44 966</p>
									</div>
								</div>

								<p class="mt-5 text-sm text-gray-500 dark:text-gray-500">© <?= date("Y") ?> UnifyDev.</p>
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
