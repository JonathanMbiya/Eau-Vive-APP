<?php
require_once('model/inventaire.php');


function renderInventaireList()
{
	include('components/badge.php');
	$invoiceOp = new Inventaire();
	$invoices = $invoiceOp->GetInventaires();
	$columns = [
		[
			"text" => "#"
		],
		[
			"text" => "Date Inventaire"
		],
		[
			"text" => "Par"
		],
		[
			"text" => "Role"
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
					$countId=0;
					foreach ($invoices as $invoice) {
					?>
						<tr>
							<td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">
								<?= ++$countId ?>
							</td>
							<td>
								<?= $invoice['dateInventaire'] ?>
							</td>
							<td>
								<div class="flex flex-col">
									<span class="font-semibold text-gray-900 dark:text-white"><?= $invoice['userName'] ?></span>
									<span class="text-sm text-gray-600 dark:text-gray-400"><?= $invoice['userEmail'] ?></span>
								</div>
							</td>
							<td>
								<?php
								if ($invoice['userRole'] == '2') {
									badge('Gérant', 'success');
								} else if ($invoice['userRole'] == '1') {
									badge('Comptable', 'info');
								} else if ($invoice['userRole'] == '0') {
									badge('Magasinier', 'warning');
								}
								?>
							</td>
							<td class="w-28 flex justify-end">
								<a href="/app/inventaires/details?id=<?= $invoice['id'] ?>" class="text-gray-900 flex items-center gap-x-1.5 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-70">
									<svg class="size-3 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
										<path fill-rule="evenodd" d="M4.998 7.78C6.729 6.345 9.198 5 12 5c2.802 0 5.27 1.345 7.002 2.78a12.713 12.713 0 0 1 2.096 2.183c.253.344.465.682.618.997.14.286.284.658.284 1.04s-.145.754-.284 1.04a6.6 6.6 0 0 1-.618.997 12.712 12.712 0 0 1-2.096 2.183C17.271 17.655 14.802 19 12 19c-2.802 0-5.27-1.345-7.002-2.78a12.712 12.712 0 0 1-2.096-2.183 6.6 6.6 0 0 1-.618-.997C2.144 12.754 2 12.382 2 12s.145-.754.284-1.04c.153-.315.365-.653.618-.997A12.714 12.714 0 0 1 4.998 7.78ZM12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" clip-rule="evenodd" />
									</svg>
									Details
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
			"Aucun inventaire trouve",
			"Commencer par creer un nouveau inventaire",
			[
				'text' => '+ Creer',
				'href' => '/app/inventaires/nouveau'
			]
		);
	}
}
?>
