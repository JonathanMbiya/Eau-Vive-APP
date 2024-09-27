<?php
require_once('model/produits.php');

function renderProductList()
{
	include('components/badge.php');
	$productOp = new Product();
	$products = $productOp->GetProducts();
	$columns = ["#", "Nom Produit", "Classe Therapeutique" ,"PrixUnitaire", "PrixAchat","Quantite", "Sensibilite Chaleur", ''];
	if (!empty($products)) {
?>
		<div class="overflow-hidden overflow-x-auto w-full">
			<table data-app-table id="search-table">
				<thead>
					<tr>
						<?php
						foreach ($columns as $column) {
						?>
							<th>
								<span class="flex items-center"><?= $column ?></span>
							</th>

						<?php
						}
						?>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach ($products as $product) {

					?>

						<tr>
							<td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">
								<?= $product['id'] ?>
							</td>
							<td>
								<div class="flex gap-x-4">
									<?php
									// if ($productOp->productIsExpired($product['id'])) {
									// 	badge('Expire', 'danger');
									// } else {
									// 	badge('Normal', 'success');
									// }
									?>
									<?= $product['nomProduit'] ?>
								</div>
							</td>
							<td>
								<?= $product['classe_therapeutique'] ?>
							</td>
						
							<td>
								<?= $product['prixUnitaire'] ?>
							</td>
							<td>
								<?= $product['prixAchat'] ?>
							</td>
							<td>
								<?= $product['quantite'] ?>
							</td>
							<td>
								<?php
								if ($product['sensibiliteChaleur'] == '1') {
									badge('Oui', 'danger');
								} else {
									badge('Non', 'success');
								}
								?>
							</td>
							
							</td>
							<td class="w-max">
								<div class="flex">
									<a href="/app/produits/editer?id=<?= $product['id'] ?>" class="h-7 flex items-center px-4 w-max text-white bg-primary-700 rounded-lg hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 sm:w-auto dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
										Editer
									</a>
								</div>
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
			'Aucun produit trouve',
			'Commencer par enregistrer un nouveau produit',
			[
				'text' => '+ Enregistrer',
				'href' => '/app/produits/nouveau'
			]
		);
	}
}
?>
