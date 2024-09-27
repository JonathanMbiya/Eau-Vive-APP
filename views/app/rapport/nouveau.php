<?php
require('system/dash.php');


$layout = new DASH(title: 'Editer Produit');
if (isset($_GET['startDate'], $_GET['endDate'])) {

	require_once('controllers/rapportController.php');
	$date1 = $_GET['startDate'];
	$date2 = $_GET['endDate'];
	$inventoryOp = new RapportController();
	$inventory = $inventoryOp->getInventory($date1, $date2);
	//$inventory = $inventoryOp->getAll

	if (!empty($inventory)) {
?>

		<div class="flex flex-col items-center gap-10 text-gray-700 dark:text-gray-300 w-full">
			<?php
			include("partials/page-action-header.php");
			renderHeader('Nouveau rapport de vente', "Rapport financier du " . $date1 . " au " . $date2,  [
				[
					'href' => '/app',
					'text' => 'Dashboard'
				],
				[
					'text' => 'Rapport',
					'href' => '/app/rapport/'
				],
				[
					'text' => 'Nouveau rapport',
					'isActive' => true
				]
			]);
			?>
			<div class="mb-20 mt-4 flex flex-col w-full container mx-auto xl:max-w-7xl">
				<?php
				include('partials/messages/messageAction.php');
				?>
				<div class="w-full p-6 md:p-10 rounded-lg bg-white dark:bg-gray-950 border border-gray-200 dark:border-gray-900">
					<form class="grid space-y-6 mx-auto max-w-5xl" action="/app/rapport/action" method="POST">
						<div class="grid sm:grid-cols-2 gap-6">
							<?php
							include("components/form.php");
							inputFormGroupLabel('Date rapport', 'date', 'dateRapport', 'dateRapport', '0', true);
							inputFormGroupLabel(
								'Total Vente',
								'number',
								'montantVente',
								'montantVente',
								'Saisir nom produit',
								true,
								[
									'value' => $inventory['totalAmountOut'],
									"isReadonly" => "true"
								]
							);
							inputFormGroupLabel(
								'Total Achat',
								'number',
								'montantAchat',
								'montantAchat',
								'0',
								true,
								[
									'value' => $inventory['totalAmountIn'],
									"isReadonly" => "true"
								]
							);
							inputHidden('action_type', 'new-rapport');
							inputHidden('du', $_GET['startDate']);
							inputHidden('au', $_GET['endDate']);
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
	<?php
	} else {
		include("partials/renderEmptyState.php");
		renderEmptyState(
			"Oops, aucune information dans la Base de donnees",
			"Aucune information pour la periode fournie",
			[
				'text' => 'Demarrer une nouvelle operation',
				'href' => '/app/mouvement-stock/nouveau'
			]
		);
	}
} else {
	?>
	<div class="flex flex-col items-center gap-10 text-gray-700 dark:text-gray-300 w-full">
		<?php
		include("partials/page-action-header.php");
		renderHeader('Effectuer un rapport', 'Effectuer une rapport pour une duree X',  [
			[
				'href' => '/app',
				'text' => 'Dashboard'
			],
			[
				'text' => 'Rapport',
				'href' => '/app/rapport/'
			],
			[
				'text' => 'Nouveau rapport',
				'isActive' => true
			]
		]);
		?>
		<div class="mb-20 mt-4 flex flex-col w-full container mx-auto xl:max-w-7xl">
			<?php
			include('partials/messages/messageAction.php');
			?>
			<div class="w-full p-6 md:p-10 rounded-lg bg-white dark:bg-gray-950 border border-gray-200 dark:border-gray-900">
				<form class="grid space-y-6 mx-auto max-w-5xl" action="/app/rapport/nouveau" method="GET">
					<div class="grid sm:grid-cols-2 gap-6">
						<?php
						include("components/form.php");
						inputFormGroupLabel('Date Debut', 'date', 'startDate', 'startDate', '12/12/2023', true, ['value' => '']);
						inputFormGroupLabel('Date Fin', 'date', 'endDate', 'endDate', '01/03/2024', true, ['value' => '']);
						?>
					</div>


					<div class="flex justify-end">
						<button type="submit" class="w-full px-5 py-3 text-sm font-medium text-center text-white bg-primary-700 rounded-lg hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 sm:w-auto dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
							Go
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php
}
?>
