<?php
require_once('model/users.php');

function renderUserList()
{
	include('components/badge.php');
	$userOp = new User();
	$users = $userOp->GetUsers();
	$columns = ["#", "User name", "Email", "Role", ''];
	if (!empty($users)) {
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
					foreach ($users as $user) {
					?>
						<tr>
							<td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">
								<?= $user['id'] ?>
							</td>
							<td>
								<div class="flex gap-x-4">
									<?= $user['userName'] ?>
								</div>
							</td>
							<td>
								<div class="flex gap-x-4">
									<?= $user['email'] ?>
								</div>
							</td>
							<td>
								<div class="flex gap-x-4">
									<?php
									if ($user['role'] == '2') {
										badge('Gérant', 'success');
									} else if ($user['role'] == '1') {
										badge('Comptable', 'info');
									} else if ($user['role'] == '0') {
										badge('Magasinier', 'warning');
									}
									?>
								</div>
							</td>
							<td class="w-max">
								<div class="flex">
									<form action="/app/users/action" method="POST" class="flex">
										<input type="hidden" name="id" value="<?= $user['id'] ?>">
										<input type="hidden" name="action_type" value="delete-user">
										<button class="h-6 rounded-lg text-sm px-3.5 bg-red-600 dark:bg-red-500 text-white flex items-center w-max hover:opacity-90">Supprimer</button>
									</form>
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
			'Aucun user trouve',
			'Commencer par enregistrer un nouveau user',
			[
				'text' => '+ Enregistrer',
				'href' => '/app/users/nouveau'
			]
		);
	}
}
?>
