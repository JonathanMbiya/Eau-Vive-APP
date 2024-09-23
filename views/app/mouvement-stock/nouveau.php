<?php
require('system/dash.php');

$layout = new DASH(title: 'Nouveau Mouvement Stock');
?>

<div class="flex flex-col items-center gap-10 text-gray-700 dark:text-gray-300 w-full">
	<?php
	include("partials/page-action-header.php");
	renderHeader('Nouveau mouvement', 'Enregistrer une entree ou une sortie',  [
		[
			'text' => 'Dashboard',
			'href' => '/app'
		],
		[
			'text' => 'Mouvement Stock',
			'href' => '/app/mouvement-stock/'
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
			<form class="grid space-y-6 mx-auto max-w-lg" action="/app/mouvement-stock/action" method="POST">
				<div class="grid gap-6">
					<?php
					include("components/form.php");
					include("partials/render/listSelectProduct.php");
					inputFormSelectGroupLabel('Type Mouvement', 'typeMouvement', 'typeMouvement', 'Selectioner un type de mouvement', ['entree' => "Mouvement d'entree", 'sortie' => 'Mouvement de sortie'], '1', true);
					inputFormGroupLabel('Date mouvement', 'date', 'dateMouvement', 'dateMouvement', '', true);
					renderProductSelectList();
					inputFormGroupLabel('Prix Unitaire', 'number', 'prix', 'prix', '1', true);
					inputFormGroupLabel('Quantite', 'number', 'quantite', 'quantite', '1', true);
					inputTextAreaGroupLabel('Raison', 'raison', 'raison', 'Raison .....', true, "");
					inputHidden('action_type', 'new-mvm');
					?>
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
