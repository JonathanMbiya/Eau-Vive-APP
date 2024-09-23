<?php
require_once("model/produits.php");
$prodModel = new Product();
$expiredProduct = $prodModel->getCountExpiredProduct();
$willExpire = $prodModel->GetWillExpireIn1Week();
$isZeroInStock = $prodModel->GetQuantityIs0();

$allProducts = $prodModel->GetProductsCount();

function getCorrectText($qte)
{
	return $qte > 1 ? "Produits" : "Produit";
}
?>

<div
	class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 lg:gap-8">
	<a
		href="app/produits"
		class="flex flex-col rounded-lg border border-gray-200 bg-white hover:border-gray-300 dark:bg-gray-900/50 dark:border-gray-900 dark:hover:border-gray-700">
		<div class="flex grow items-center justify-between p-5">
			<dl>
				<dt class="text-2xl font-bold text-gray-900 dark:text-white"><?= $allProducts == "" ? 0 : $allProducts ?></dt>
				<dd class="text-sm font-medium text-gray-600 dark:text-gray-400">
					<?= getCorrectText($allProducts) ?>
				</dd>
			</dl>
			<div
				class="flex items-center text-sm font-medium">
				<svg class="size-6 text-gray-800 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
					<path fill-rule="evenodd" d="M5 3a1 1 0 0 0 0 2h.687L7.82 15.24A3 3 0 1 0 11.83 17h2.34A3 3 0 1 0 17 15H9.813l-.208-1h8.145a1 1 0 0 0 .979-.796l1.25-6A1 1 0 0 0 19 6h-2.268A2 2 0 0 1 15 9a2 2 0 1 1-4 0 2 2 0 0 1-1.732-3h-1.33L7.48 3.796A1 1 0 0 0 6.5 3H5Z" clip-rule="evenodd" />
					<path fill-rule="evenodd" d="M14 5a1 1 0 1 0-2 0v1h-1a1 1 0 1 0 0 2h1v1a1 1 0 1 0 2 0V8h1a1 1 0 1 0 0-2h-1V5Z" clip-rule="evenodd" />
				</svg>

			</div>
		</div>
		<div
			class="border-t border-gray-100 dark:border-gray-800/80 px-5 py-3 text-xs font-medium text-emerald-600 dark:text-emerald-500">
			Produits enregistrés
		</div>
	</a>

	<a
		href="app/produits"
		class="flex flex-col rounded-lg border border-gray-200 bg-white hover:border-gray-300 dark:bg-gray-900/50 dark:border-gray-900 dark:hover:border-gray-700">
		<div class="flex grow items-center justify-between p-5">
			<dl>
				<dt class="text-2xl font-bold text-gray-900 dark:text-white"><?= $expiredProduct == "" ? 0 : $expiredProduct  ?></dt>
				<dd class="text-sm font-medium text-gray-600 dark:text-gray-400">
					<?= getCorrectText($expiredProduct) ?>
				</dd>
			</dl>
			<div
				class="flex items-center text-sm font-medium">
				<svg class="size-6 text-gray-800 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
					<path fill-rule="evenodd" d="M5 3a1 1 0 0 0 0 2h.687L7.82 15.24A3 3 0 1 0 11.83 17h2.34A3 3 0 1 0 17 15H9.813l-.208-1h8.145a1 1 0 0 0 .979-.796l1.25-6A1 1 0 0 0 19 6h-2.268A2 2 0 0 1 15 9a2 2 0 1 1-4 0 2 2 0 0 1-1.732-3h-1.33L7.48 3.796A1 1 0 0 0 6.5 3H5Z" clip-rule="evenodd" />
					<path fill-rule="evenodd" d="M14 5a1 1 0 1 0-2 0v1h-1a1 1 0 1 0 0 2h1v1a1 1 0 1 0 2 0V8h1a1 1 0 1 0 0-2h-1V5Z" clip-rule="evenodd" />
				</svg>

			</div>
		</div>
		<div
			class="border-t border-gray-100 dark:border-gray-800/80 px-5 py-3 text-xs font-medium text-red-600 dark:text-red-500">
			Produits perimés
		</div>
	</a>
	<a
		href="app/produits"
		class="flex flex-col rounded-lg border border-gray-200 bg-white hover:border-gray-300 dark:bg-gray-900/50 dark:border-gray-900 dark:hover:border-gray-700">
		<div class="flex grow items-center justify-between p-5">
			<dl>
				<dt class="text-2xl font-bold text-gray-900 dark:text-white"><?= $isZeroInStock == "" ? 0 : $isZeroInStock ?></dt>
				<dd class="text-sm font-medium text-gray-600 dark:text-gray-400">
					<?= getCorrectText($isZeroInStock) ?>
				</dd>
			</dl>
			<div
				class="flex items-center text-sm font-medium">
				<svg class="size-6 text-gray-800 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
					<path fill-rule="evenodd" d="M5 3a1 1 0 0 0 0 2h.687L7.82 15.24A3 3 0 1 0 11.83 17h2.34A3 3 0 1 0 17 15H9.813l-.208-1h8.145a1 1 0 0 0 .979-.796l1.25-6A1 1 0 0 0 19 6h-2.268A2 2 0 0 1 15 9a2 2 0 1 1-4 0 2 2 0 0 1-1.732-3h-1.33L7.48 3.796A1 1 0 0 0 6.5 3H5Z" clip-rule="evenodd" />
					<path fill-rule="evenodd" d="M14 5a1 1 0 1 0-2 0v1h-1a1 1 0 1 0 0 2h1v1a1 1 0 1 0 2 0V8h1a1 1 0 1 0 0-2h-1V5Z" clip-rule="evenodd" />
				</svg>

			</div>
		</div>
		<div
			class="border-t border-gray-100 dark:border-gray-800/80 px-5 py-3 text-xs font-medium text-blue-600 dark:text-blue-500">
			Produits avec insuffisance
		</div>
	</a>
</div>
