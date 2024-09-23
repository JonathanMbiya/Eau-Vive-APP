<?php
require_once('model/produits.php');

function renderProductSelectList()
{
	$productOp = new Product();
	$products = $productOp->GetProducts();
	if (!empty($products)) {
?>
		<div>
			<label for="idProduit" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
				Liste Produit
			</label>
			<select name="idProduit" id="idProduit" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-900/50 dark:border-gray-900 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
				<option>Selectionnez un produit</option>
				<?php
				foreach ($products as $product) {
				?>
					<option value="<?= $product['id'] ?>"><?= $product['nomProduit'] ?></option>
				<?php
				}
				?>
			</select>
		</div>
	<?php

	} else {
	?>
		<div>
			<label for="idProduit" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
				Produit
			</label>
			<select name="idProduit" id="idProduit" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-900/50 dark:border-gray-900 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
				<option>Selectionnez un produit</option>
			</select>
		</div>
<?php
	}
}
?>
