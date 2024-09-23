<?php
require_once('model/mouvements.php');

function getProductName($id)
{
	$productM = new MouvementStock();
	$prod = $productM->GetProduct($id);
	return $prod["nomProduit"];
}

function getTitle($type)
{
	return $type == "all" ? "" : ($type == "sortie" ? " De sortie" : " D'entree");
}
function renderMouvementList($type = "all")
{
	include('components/badge.php');
	$productOp = new MouvementStock();
	$mvmStockLst = $type == "all" ? $productOp->GetMouvements() : $productOp->GetMouvementsByType($type);
	$columns = ["#", "Type", "Date", "Nom produit", "Quantite", "Raison"];
	if (!empty($mvmStockLst)) {
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
					foreach ($mvmStockLst as $product) {
					?>
						<tr>
							<td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">
								<?= $product['id'] ?>
							</td>
							<td>
								<div class="flex gap-x-4">
									<?php
									if ($product['typeMouvement'] == 'sortie') {
										badge('Sortie', 'danger');
									} else {
										badge('Entree', 'success');
									}
									?>
								</div>
							</td>
							<td>
								<?= $product['dateMouvement'] ?>
							</td>
							<td>
								<?= getProductName($product['idProduit']) ?>
							</td>
							<td>
								<?= $product['quantite'] ?>
							</td>
							<td>
								<?= $product['raison'] ?>
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
			"Aucun mouvement" . getTitle($type) . " trouve",
			"Commencer par enregistrer un nouveau mouvement de stock",
			[
				'text' => '+ Enregistrer',
				'href' => '/app/mouvement-stock/nouveau'
			]
		);
	}
}
?>
