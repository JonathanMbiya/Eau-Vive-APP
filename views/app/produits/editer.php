<?php
require('system/dash.php');
require_once('controllers/productsCtrl.php');
$productOp = new ProductController();
$product = $productOp->GetProduct($_GET['id']);


$layout = new DASH(title: 'Editer Produit');
if (isset($_GET['id'])) {


	if (!empty($product)) {
?>

		<div class="flex flex-col items-center gap-10 text-gray-700 dark:text-gray-300 w-full">
			<?php
			include("partials/page-action-header.php");
			renderHeader('Editer Produit #' . $product['id'], 'Enregistrer un nouveau produit',  [
				[
					'href' => '/app',
					'text' => 'Dashboard'
				],
				[
					'text' => 'Liste Produits',
					'href' => '/app/produits/'
				],
				[
					'text' => 'Editer produit',
					'isActive' => true
				]
			]);
			?>
			<div class="mb-20 mt-4 flex flex-col w-full container mx-auto xl:max-w-7xl">
				<?php
				include('partials/messages/messageAction.php');
				?>
				<div class="w-full p-6 md:p-10 rounded-lg bg-white dark:bg-gray-950 border border-gray-200 dark:border-gray-900">
					<form class="grid space-y-6 mx-auto max-w-5xl" action="/app/produits/action" method="POST">
						<div class="grid sm:grid-cols-2 gap-6">
							<?php
							include("components/form.php");
							inputFormGroupLabel('Nom Produit', 'text', 'nomProduit', 'nomProduit', 'Saisir nom produit', true, ['value' => $product['nomProduit']]);
							inputFormGroupLabel('Categorie', 'text', 'categorie', 'categorie', 'Saisir categorie', true, ['value' => $product['categorie']]);
							inputFormGroupLabel('Quantite', 'number', 'quantite', 'quantite', '0', true, ['value' => $product['quantite']]);
							inputFormGroupLabel('Prix Unitaire', 'number', 'prixUnitaire', 'prixUnitaire', '0', true, ['value' => $product['prixUnitaire']]);
							inputFormGroupLabel('Date Peremption', 'date', 'datePeremption', 'datePeremption', '12/12/2023', true, ['value' => $product['datePeremption']]);
							inputHidden('action_type', 'edit');
							inputHidden('id', $product['id']);
							?>
							<div class="flex flex-col gap-6 sm:flex-row sm:gap-10 sm:items-center sm:h-full pt-5">
								<div>
									<?php
									inputCheckbox('sensibiliteChaleur', 'sensibiliteChaleur', $product['sensibiliteChaleur'] == '1');
									?>
									<label for="sensibiliteChaleur" class="text-sm font-medium text-gray-600 dark:text-gray-400">Sensibilite a la Chaleur</label>
								</div>
								<div>
									<?php
									inputCheckbox('estCouteux', 'estCouteux', $product['estCouteux'] == '1');
									?>
									<label for="estCouteux" class="text-sm font-medium text-gray-600 dark:text-gray-400">Est couteux</label>
								</div>
							</div>

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
	} else {
		include("partials/renderEmptyState.php");
		renderEmptyState(
			"Oops, aucune information dans la Base de donnees",
			"Ce produit n'existe plus dans la BDD",
			[
				'text' => 'Liste Produits',
				'href' => '/app/produits/'
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
