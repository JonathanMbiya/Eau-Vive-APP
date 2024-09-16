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
			<form class="grid space-y-6 mx-auto max-w-lg" action="/app/users/action" method="POST">
				<div class="grid gap-6">
					<?php
					include("components/form.php");
					inputFormGroupLabel("Nom d'utilisateur", 'text', 'userName', 'userName', 'johndoe', true);
					inputFormGroupLabel('Email', 'email', 'email', 'email', 'johnkatmj@gmail.com', true);
					inputFormSelectGroupLabel('Role', 'role', 'role','Selectioner le role' ,['0' => 'Magasinier', '1' => 'Comptable', '2' => 'Gérant'], '0', true);
					inputFormGroupLabel('Mot de passe', 'password', 'motDePasse', 'motDePasse', '**********', true);
					inputHidden('action_type', 'new-user');
					?>
					<div class="flex flex-col gap-6 sm:flex-row sm:gap-10 sm:items-center sm:h-full pt-5">

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
