<?php
require_once('model/rapport.php');


function renderRappoList()
{
	include('components/badge.php');
	$rapportOp = new Rapport();
	$rapports = $rapportOp->GetRapport();
	$columns = [
		[
			"text" => "#"
		],
		[
			"text" => "Date Rapport"
		],
		[
			"text" => "Periode"
		],
		[
			"text" => "Montant Achat"
		],
		[
			"text" => "Montant Vente",
			"class" => ""
		]
	];
	if (!empty($rapports)) {
?>
		<div class="overflow-hidden overflow-x-auto w-full">
			<table data-app-table id="search-table">
				<thead>
					<tr>
						<?php
						foreach ($columns as $column) {
						?>
							<th class="<?= key_exists('class', $column) ? $column['class'] : '' ?>">
								<span class="flex items-center"><?= $column['text'] ?></span>
							</th>
						<?php
						}
						?>
					</tr>
				</thead>
				<tbody>
					<?php
					$countId=0;
					foreach ($rapports as $rapport) {
					?>
						<tr>
							<td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">
								<?= ++$countId ?>
							</td>
							<td>
								<?= $rapport['dateRapport'] ?>
							</td>
							<td>
								Du <?= $rapport["du"] ?> au <?= $rapport['au'] ?>
							</td>
							<td>
								<?= badge($rapport["du"]." FC", 'success') ?>
							</td>
							<td class="w-28 flex justify-end">
							<?= badge($rapport["du"]." FC", 'success') ?>
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
			"Aucun inventaire trouve",
			"Commencer creer un nouveau rapport",
			[
				'text' => '+ Creer',
				'href' => '/app/rapport/nouveau'
			]
		);
	}
}
?>
