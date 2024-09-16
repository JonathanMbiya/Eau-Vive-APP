<?php
function renderHeaderMain($title, $description, $link, $breadcrumbs = array())
{
?>
	<div class="container mx-auto pt-6 lg:pt-8 xl:max-w-7xl">
		<div
			class="flex flex-none items-center justify-center gap-2 rounded sm:justify-end">
			<nav class="flex" aria-label="Breadcrumb">
				<ol class="inline-flex items-center space-x-1 md:space-x-3">
					<?php
					foreach ($breadcrumbs as $breadcrumb) {
						if (array_key_exists('isActive', $breadcrumb) && $breadcrumb['isActive']) {
					?>
							<li aria-current="page">
								<div class="flex items-center">
									<svg class="mx-1 w-1 h-5" viewBox="0 0 5 20" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M4.12561 1.13672L0.999943 18.8633" stroke="#E5E7EB" stroke-width="1.6" stroke-linecap="round" />
									</svg>
									<span class="ml-1 text-base font-medium text-primary-600 dark:text-primary-500 md:ml-2 ">
										<?= $breadcrumb['text'] ?>
									</span>
								</div>
							</li>
						<?php

						} else {
						?>
							<li class="inline-flex items-center">
								<div class="flex items-center">
									<svg class="mx-1 w-1 h-5" viewBox="0 0 5 20" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M4.12561 1.13672L0.999943 18.8633" stroke="#E5E7EB" stroke-width="1.6" stroke-linecap="round" />
									</svg>
									<a href="<?= $breadcrumb['href'] ?>" class="ml-1 inline-flex items-center text-base font-medium text-gray-900 dark:text-white hover:text-primary-600 dark:hover:text-primary-500">
										<?= $breadcrumb['text'] ?>
									</a>
								</div>
							</li>

					<?php
						}
					}
					?>

				</ol>
			</nav>
		</div>
		<div
			class="mt-4 flex flex-col gap-2 text-center sm:flex-row sm:items-center sm:justify-between sm:text-start">
			<div class="grow">
				<h1 class="mb-1 text-xl font-bold text-gray-900 dark:text-white"><?= $title ?></h1>
				<h2 class="text-sm font-medium text-gray-600 dark:text-gray-400">
					<?= $description ?>
				</h2>
			</div>
			<div class="flex">
				<a href="<?= $link['href'] ?>" class="inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
					<?= $link['text'] ?>
				</a>
			</div>
		</div>
	</div>
<?php
}
