<?php
require_once('model/facture.php');

function renderInvoiceRowList($id)
{
	$invoiceOp = new Facture();
	$invoiceRows = $invoiceOp->GetFactureRows($id);

	if (!empty($invoiceRows)) {
?>
		<!-- Table -->
		<div class="mt-6">
			<div class="border border-gray-200 p-4 rounded-lg space-y-4 dark:border-gray-900">
				<div class="hidden sm:grid sm:grid-cols-5">
					<div class="sm:col-span-2 text-xs font-medium text-gray-700 uppercase dark:text-gray-300">Produit</div>
					<div class="text-start text-xs font-medium text-gray-700 uppercase dark:text-gray-300">Quantie</div>
					<div class="text-start text-xs font-medium text-gray-700 uppercase dark:text-gray-300">PU</div>
					<div class="text-end text-xs font-medium text-gray-700 uppercase dark:text-gray-300">Total</div>
				</div>

				<?php
				foreach ($invoiceRows as $invoiceRow) {
				?>
					<div class="hidden sm:block border-b border-gray-200 dark:border-gray-900"></div>
					<div class="grid grid-cols-3 sm:grid-cols-5 gap-2">
						<div class="col-span-full sm:col-span-2">
							<h5 class="sm:hidden text-xs font-medium text-gray-700 uppercase dark:text-gray-300">
								Produit
							</h5>
							<p class="font-medium text-gray-800 dark:text-gray-200">
								<?= $invoiceRow['productName'] ?>
							</p>
						</div>
						<div>
							<h5 class="sm:hidden text-xs font-medium text-gray-700 uppercase dark:text-gray-300">Quantite</h5>
							<p class="text-gray-800 dark:text-gray-200">
								<?= $invoiceRow['quantity'] ?>
							</p>
						</div>
						<div>
							<h5 class="sm:hidden text-xs font-medium text-gray-700 uppercase dark:text-gray-300">PU</h5>
							<p class="text-gray-800 dark:text-gray-200">
								<?= $invoiceRow['price'] ?>
							</p>
						</div>
						<div>
							<h5 class="sm:hidden text-xs font-medium text-gray-700 uppercase dark:text-gray-300">Total</h5>
							<p class="sm:text-end text-gray-800 dark:text-gray-200">
								<?= $invoiceRow['total'] ?>
							</p>
						</div>
					</div>
				<?php
				}
				?>
			</div>
		</div>
		<!-- End Table -->
<?php
	} else {
		echo "Mec, tu t'es bien goure";
	}
}
?>
