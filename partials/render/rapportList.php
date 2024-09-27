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
								<?= badge($rapport["montantAchat"]." FC", 'success') ?>
							</td>
							<td class="w-28 flex justify-end">
							<?= badge($rapport["montantVente"]." FC", 'success') ?>
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

function renderAllMouvements($startDate, $endDate)
{
    include('components/badge.php');
    $mouvementOp = new MouvementStock();
    $mouvements = $mouvementOp->getAllMouvements($startDate, $endDate);
    
    $columns = [
        [
            "text" => "#"
        ],
        [
            "text" => "Date Mouvement"
        ],
        [
            "text" => "Nom Produit"
        ],
        [
            "text" => "Type Mouvement"
        ],
        [
            "text" => "Quantité"
        ],
        [
            "text" => "Prix Unitaire"
        ],
        [
            "text" => "Total"
        ]
    ];

    // Initialisation des totaux
    $totalEntrees = 0;
    $totalSorties = 0;

    if (!empty($mouvements)) {
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
                    $countId = 0;
                    foreach ($mouvements as $mouvement) {
                        $nomProduit = $mouvement['nomProduit'];
                        $typeMouvement = $mouvement['typeMouvement'];
                        $quantite = $mouvement['quantite'];
                        $prix = $mouvement['prix'];
                        $total = $quantite * $prix;

                        // Calcul des totaux
                        if ($typeMouvement === 'entree') {
                            $totalEntrees += $total;
                        } elseif ($typeMouvement === 'sortie') {
                            $totalSorties += $total;
                        }
                    ?>
                        <tr>
                            <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <?= ++$countId ?>
                            </td>
                            <td>
                                <?= $mouvement['dateMouvement'] ?>
                            </td>
                            <td>
                                <?= $nomProduit ?>
                            </td>
                            <td>
                                <?= ucfirst($typeMouvement) ?>
                            </td>
                            <td>
                                <?= $quantite ?>
                            </td>
                            <td>
                                <?= number_format($prix, 2) ?> FC
                            </td>
                            <td>
                                <?= number_format($total, 2) ?> FC
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5" class="text-right font-bold">Total Entrées</td>
                        <td colspan="2">
                            <?= badge(number_format($totalEntrees, 2) . " FC", 'success') ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-right font-bold">Total Sorties</td>
                        <td colspan="2">
                            <?= badge(number_format($totalSorties, 2) . " FC", 'danger') ?>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
<?php
    } else {
        echo "<p>Aucun mouvement de stock trouvé pour cette période.</p>";
    }
}

?>
