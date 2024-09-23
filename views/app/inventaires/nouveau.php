<?php
require('system/dash.php');

$layout = new DASH(title: 'Nouveau Inventaire');
?>
<?php
require_once("model/produits.php");
$productModel = new Product();
$products = $productModel->GetProducts();
?>
<div class="flex flex-col items-center gap-10 text-gray-700 dark:text-gray-300 w-full">
	<?php
	include("partials/page-action-header.php");
	renderHeader('Nouveau inventaire', 'Enregistrer un nouveau inventaire',  [
		[
			'text' => 'Dashboard',
			'href' => '/app'
		],
		[
			'text' => 'Inventaires',
			'href' => '/app/inventaires/'
		],
		[
			'text' => 'Nouveau',
			'isActive' => true
		]
	]);
	?>
	<div class="mb-20 mt-4 flex flex-col w-full container mx-auto xl:max-w-7xl">
		<?php
		include('partials/messages/messageAction.php');
		?>
		<div class="w-full p-6 md:p-10 rounded-lg bg-white dark:bg-gray-950 border border-gray-200 dark:border-gray-900">
			<form class="grid space-y-6" action="/app/inventaires/action" method="POST">
				<div class="grid gap-6 max-w-lg">
					<?php
					include("components/form.php");
					inputFormGroupLabel('Date Inventaire', 'date', 'dateInventaire', 'dateInventaire', '', true);
					inputHidden('action_type', 'new-inventaire');
					?>
				</div>

				<div>
					<div id="product-list" class="flex flex-col gap-y-4">
						<div data-row-invoice data-invoice-row-id="1" class="grid items-end gap-3 grid-cols-5 md:grid-cols-10 p-4 rounded-lg border border-gray-200 dark:border-gray-800/70">
							<div class="col-span-5 md:col-span-4">
								<label for="product-1" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Produit</label>
								<div data-invoice-product-select-list data-row-id="1" class="flex w-full relative">
									<div class="relative w-full">
										<input type="text" id="product-1" place-holder="-- Selectionnez un produit --" data-dropdown-trigger class="bg-gray-50 w-full border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block  p-2.5 dark:bg-gray-900/50 dark:border-gray-900 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" readonly required />
										<input data-product-id-zone type="hidden" name="productId[]" class="hidden" />
										<input type="hidden" data-qte-in-stock value="0" />
									</div>
									<div data-dropdown-content data-state="close" id="dropdown-prod-lst-1" class="z-10 hidden data-[state=open]:flex w-full bg-white divide-y divide-gray-100 rounded-lg shadow  dark:bg-gray-900 absolute left-0 top-[calc(100%+10px)]">
										<ul class="py-2 text-sm text-gray-700 dark:text-gray-200 px-1.5 flex flex-col space-y-0.5 w-full">
											<?php foreach ($products as $product): ?>
												<li data-product-item data-product-id="<?= $product['id'] ?>" data-product-name="<?php echo $product["nomProduit"]; ?>" data-price-value="<?= $product['prixUnitaire'] ?>" data-product-qte="<?= $product['quantite'] ?>" class="cursor-pointer px-3 py-1.5 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-800/60 transition ease-linear inline-flex w-full">
													<?= $product['nomProduit']; ?>
												</li>
											<?php endforeach; ?>
										</ul>
									</div>
								</div>
							</div>
							<div class="col-span-2">
								<label for="price-1" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Prix</label>
								<input data-input-price type="text" value="0" id="price-1" name="productPrice[]" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-900/50 dark:border-gray-900 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" readonly>
							</div>
							<div class="col-span-2">
								<label class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Quantity</label>
								<input data-user-qte type="number" readonly value="0" name="quantity[]" min="0" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-900/50 dark:border-gray-900 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
							</div>
							<div class="md:col-span-2">
								<label class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Total</label>
								<input data-user-total type="number" value="0" min="0" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-900/50 dark:border-gray-900 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" readonly>
							</div>
						</div>
					</div>
					<button data-add-new-row class="mt-5">
						+ Ajouter une ligne
					</button>
				</div>

				<div class="flex justify-end">
					<button type="submit" class="w-full px-5 py-3 text-sm font-medium text-center text-white bg-primary-700 rounded-lg hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 sm:w-auto dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
						Enregistrer
					</button>
				</div>
			</form>
		</div>
	</div>
</div>

<?php
$qteEditable=false;

include("partials/scriptInventaire.php");
?>
