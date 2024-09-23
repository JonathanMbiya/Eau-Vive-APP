<script>
	let productIndex = 2;

	function addRow() {
		const productList = document.getElementById('product-list');
		const newProduct = document.createElement('div');
		newProduct.innerHTML = `
		<div data-row-invoice data-invoice-row-id="${productIndex}" class="grid items-end gap-3 grid-cols-5 md:grid-cols-10 p-4 rounded-lg border border-gray-200 dark:border-gray-800/70">
			<div class="col-span-5 md:col-span-4">
				<label for="product-${productIndex}" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Produit</label>
				<div data-invoice-product-select-list data-row-id="${productIndex}" class="flex w-full relative">
					<div class="relative w-full">
					<input type="text" id="product-${productIndex}" place-holder="-- Selectionnez un produit --"  data-dropdown-trigger class="bg-gray-50 w-full border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block  p-2.5 dark:bg-gray-900/50 dark:border-gray-900 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" readonly required/>
					<input data-product-id-zone type="hidden" name="productId[]" class="hidden"/>
					<input type="hidden" data-qte-in-stock value="0"/>
					</div>
					<div data-dropdown-content data-state="close" id="dropdown-prod-lst-${productIndex}" class="z-10 hidden data-[state=open]:flex w-full bg-white divide-y divide-gray-100 rounded-lg shadow  dark:bg-gray-900 absolute left-0 top-[calc(100%+10px)]">
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
				<label for="price-${productIndex}" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Prix</label>
				<input data-input-price type="text" value="0" id="price-${productIndex}" name="productPrice[]" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-900/50 dark:border-gray-900 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" readonly>
			</div>
			<div class="col-span-2">
				<label class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Quantity</label>
				<input data-user-qte type="number" value="0" name="quantity[]" min="0" <?php if (!$qteEditable) { ?> readonly <?php } ?> class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-900/50 dark:border-gray-900 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
			</div>
			<div class="md:col-span-2">
				<label class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Total</label>
				<input data-user-total type="number" value="0" min="0" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-900/50 dark:border-gray-900 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" readonly>
			</div>
		</div>
    	`;
		productList.appendChild(newProduct);
		productIndex++;
	}

	function productAlreadyExist(productId) {
		const rows = Array.from(document.querySelectorAll("[data-row-invoice]"))
		for (const row of rows) {
			const rowProductId = row.querySelector("[data-product-id-zone]").value
			if (rowProductId === productId) {
				return true
			}
		}
		return false;
	}
</script>
