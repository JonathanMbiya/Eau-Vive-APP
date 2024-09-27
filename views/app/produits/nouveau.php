<?php
require('system/dash.php');

$layout = new DASH(title: 'Nouveau Produits');
?>

<div class="flex flex-col items-center gap-10 text-gray-700 dark:text-gray-300 w-full">
	<?php
	include("partials/page-action-header.php");
	renderHeader('Nouveau produit', 'Enregistrer un nouveau produit',  [
		[
			'text' => 'Dashboard',
			'href' => '/app'
		],
		[
			'text' => 'Liste Produits',
			'href' => '/app/produits/'
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
			<form class="grid space-y-6 mx-auto max-w-5xl" action="/app/produits/action" method="POST">
				<div class="grid sm:grid-cols-2 gap-6">
					<?php
					include("components/form.php");
					// Catégories sous la classe thérapeutique
					$classes_therapeutiques = [
						'antibiotique' => 'Antibiotique',
						'antiviraux' => 'Antiviraux',
						'antifongiques' => 'Antifongiques',
						'anti-inflammatoires' => 'Anti-inflammatoires',
						'analgesiques' => 'Analgésiques'
					];

					// Catégories sous la forme pharmaceutique
					$formes_pharmaceutiques = [
						'comprimes' => 'Comprimés',
						'gélules' => 'Gélules',
						'sirop' => 'Sirop',
						'injection' => 'Injection',
						'crème' => 'Crème'
					];
					inputFormGroupLabel('Nom Produit', 'text', 'nomProduit', 'nomProduit', 'Saisir nom produit', true);
					inputFormSelectGroupLabel('Classe Thérapeutique', 'classe_therapeutique', 'classe_therapeutique', 'Sélectionner une classe thérapeutique', $classes_therapeutiques, true);
					inputFormSelectGroupLabel('Forme Pharmaceutique', 'forme_pharmaceutique', 'forme_pharmaceutique', 'Sélectionner une forme pharmaceutique', $formes_pharmaceutiques, true);
					inputFormGroupLabel('Quantite', 'number', 'quantite', 'quantite', '0', true);
					inputFormGroupLabel('Prix Unitaire', 'number', 'prixUnitaire', 'prixUnitaire', '0', true);
					inputFormGroupLabel('Prix Vente', 'number', 'prixVente', 'prixVente', '0', true);
					inputFormGroupLabel('Date Peremption', 'date', 'datePeremption', 'datePeremption', '12/12/2023', true);
					inputHidden('action_type', 'new-product');
					?>
					<div class="flex flex-col gap-6 sm:flex-row sm:gap-10 sm:items-center sm:h-full pt-5">
						<div>
							<?php
							inputCheckbox('sensibiliteChaleur', 'sensibiliteChaleur');
							?>
							<label for="sensibiliteChaleur" class="text-sm font-medium text-gray-600 dark:text-gray-400">Sensibilite a la Chaleur</label>
						</div>
						<div>
							<?php
							inputCheckbox('SensibiliteLumiere', 'SensibiliteLumiere');
							?>
							<label for="SensibiliteLumiere" class="text-sm font-medium text-gray-600 dark:text-gray-400">Sensible a lumiere</label>
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
