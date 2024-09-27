<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("model/produits.php");
require_once("model/mouvements.php"); // Importer la classe MouvementStock

class ProductController extends Product
{
    public function save($post)
    {
        $productName = $post['nomProduit'];
        $statusMsg = '';
        $status = '';

        // Vérifier si le produit existe déjà
        if ($this->productExist($productName)) {
            $statusMsg = 'Ce produit existe déjà';
            $status = 'danger';
        } else {
            // Récupérer les données du produit depuis le formulaire
            $productName = !empty($post['nomProduit']) ? trim($post['nomProduit']) : '';
            //$category = !empty($post['categorie']) ? trim($post['categorie']) : '';
			$forme_pharmaceutique = !empty($post['forme_pharmaceutique']) ? trim($post['forme_pharmaceutique']) : '';
			$classe_therapeutique = !empty($post['classe_therapeutique']) ? trim($post['classe_therapeutique']) : '';
            $qte = !empty($post['quantite']) ? $post['quantite'] : 0;
            $unitPrice = !empty($post['prixUnitaire']) ? $post['prixUnitaire'] : 0;
			$prixAchatTotal = $unitPrice * $qte;
            $perimptionDate = !empty($post['datePeremption']) ? $post['datePeremption'] : '';
            $sensibility = !empty($post["sensibiliteChaleur"]) ? '1' : '0';
            $isHighPriced = !empty($post["SensibiliteLumiere"]) ? '1' : '0';

            $valErr = '';

            // Validation des champs obligatoires
            if (empty($productName)) {
                $valErr .= 'Vous devez saisir le nom du produit.<br/>';
            }
            if (empty($forme_pharmaceutique)) {
                $valErr .= 'Vous devez saisir la catégorie du produit.<br/>';
            }
			if (empty($classe_therapeutique)) {
                $valErr .= 'Vous devez saisir la catégorie du produit.<br/>';
            }
            if (empty($perimptionDate)) {
                $valErr .= 'La date de péremption est obligatoire.<br/>';
            }
            if ($qte <= 0) {
                $valErr .= 'La quantité doit être supérieure à 0.<br/>';
            }

            // Si la validation est réussie, insérer le produit
            if (empty($valErr)) {
                $productData = array(
                    'nomProduit' => $productName,
                    //'categorie' => $category,
					'forme_pharmaceutique' => $forme_pharmaceutique,
					'classe_therapeutique' => $classe_therapeutique,
                    'quantite' => $qte,
                    'prixUnitaire' => $unitPrice,
					'prixAchat'=>$prixAchatTotal,
                    'datePeremption' => $perimptionDate,
                    'sensibiliteChaleur' => $sensibility,
                    'SensibiliteLumiere' => $isHighPriced,
                    'status' => "active"
                );
                $insert = $this->InsertProduct($productData);
				
				if ($insert) {
					error_log("Produit ajouté avec succès77777, ID : " . $insert);
					$mouvementStock = new MouvementStock();
					$mouvementData = array(
						'idProduit' => $insert,
						'typeMouvement' => 'entree',
						'quantite' => $qte,
						'dateMouvement' => date('Y-m-d'),
						'prix' => $unitPrice,
						'prixAchat' => $prixAchat,
						'raison' => 'Ajout initial du produit'
					);
				
					error_log("Données du mouvement de stock : " . var_export($mouvementData, true));
				
					if ($mouvementStock->InsertMouvement($mouvementData)) {
						error_log("Mouvement de stock ajouté pour le produit ID : " . $insert);
					} else {
						error_log("Erreur lors de l'ajout du mouvement de stock");
					}
				}
								
            } else {
                $status = 'danger';
                $statusMsg = '<p>Veuillez remplir tous les champs obligatoires:</p>' . trim($valErr, '<br/>');
            }
        }

        return [
            'status' => $status,
            'message' => $statusMsg
        ];
    }
}
