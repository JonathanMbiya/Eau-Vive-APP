<?php
require_once('model/facture.php');

function renderInvoiceList($date = "")
{
	$invoiceOp = new Facture();
	$invoices = $date == "" ? $invoiceOp->GetFactures() : $invoiceOp->GetFacturesByDate($date);
	$columns = [
		[
			"text" => "#"
		],
		[
			"text" => "Date facture"
		],
		[
			"text" => "Montant"
		],
		[
			"text" => "",
			"class" => "w-28"
		]
	];
	if (!empty($invoices)) {
?>
		<div class="overflow-hidden overflow-x-auto w-full">
			<table data-app-table id="search-table">
				<thead>
					<tr>
						<?php
						foreach ($columns as $column) {
						?>
							<th class="<?= key_exists('class', $column) ? $column['class'] : '' ?>">
								<span class="flex items-center"><?= $column['text'] ?></span>
							</th>

						<?php
						}
						?>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach ($invoices as $invoice) {
					?>
						<tr>
							<td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">
								<?= $invoice['id'] ?>
							</td>
							<td>
								<?= $invoice['dateFacture'] ?>
							</td>
							<td>
								<?= $invoice['montantTotal'] ?> Fc
							</td>
							<td class="w-28 flex justify-end">
								<a href="/app/factures/imprimer?id=<?= $invoice["id"] ?>" class="text-gray-900 flex items-center gap-x-1.5 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-70">
									<svg class="size-3 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
										<path fill-rule="evenodd" d="M8 3a2 2 0 0 0-2 2v3h12V5a2 2 0 0 0-2-2H8Zm-3 7a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h1v-4a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v4h1a2 2 0 0 0 2-2v-5a2 2 0 0 0-2-2H5Zm4 11a1 1 0 0 1-1-1v-4h8v4a1 1 0 0 1-1 1H9Z" clip-rule="evenodd" />
									</svg>

									Imprimer
								</a>
							</td>
						</tr>
					<?php
					}
					?>
				</tbody>
			</table>
		</div>
<?php
	} else {
		include("partials/renderEmptyState.php");
		renderEmptyState(
			"Aucune facture trouvee",
			"Commencer par creer une nouvelle facture",
			[
				'text' => '+ Creer',
				'href' => '/app/factures/nouveau'
			]
		);
	}
}
?>
