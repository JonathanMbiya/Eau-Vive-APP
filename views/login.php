<?php
require('system/main.php');

$layout = new HTML(title: 'Login Form');
?>

<div class="flex flex-col items-center justify-center px-6 pt-8 mx-auto md:h-screen pt:mt-0 dark:bg-gray-950">
	<a href="" class="flex items-center justify-center mb-8 text-2xl font-semibold lg:mb-10 dark:text-white">
		<svg class="size-6 mr-3 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
			<path fill-rule="evenodd" d="M20.29 8.567c.133.323.334.613.59.85v.002a3.536 3.536 0 0 1 0 5.166 2.442 2.442 0 0 0-.776 1.868 3.534 3.534 0 0 1-3.651 3.653 2.483 2.483 0 0 0-1.87.776 3.537 3.537 0 0 1-5.164 0 2.44 2.44 0 0 0-1.87-.776 3.533 3.533 0 0 1-3.653-3.654 2.44 2.44 0 0 0-.775-1.868 3.537 3.537 0 0 1 0-5.166 2.44 2.44 0 0 0 .775-1.87 3.55 3.55 0 0 1 1.033-2.62 3.594 3.594 0 0 1 2.62-1.032 2.401 2.401 0 0 0 1.87-.775 3.535 3.535 0 0 1 5.165 0 2.444 2.444 0 0 0 1.869.775 3.532 3.532 0 0 1 3.652 3.652c-.012.35.051.697.184 1.02ZM9.927 7.371a1 1 0 1 0 0 2h.01a1 1 0 0 0 0-2h-.01Zm5.889 2.226a1 1 0 0 0-1.414-1.415L8.184 14.4a1 1 0 0 0 1.414 1.414l6.218-6.217Zm-2.79 5.028a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2h-.01Z" clip-rule="evenodd" />
		</svg>
		<span class="self-center text-lg font-semibold sm:text-2xl whitespace-nowrap dark:text-white">Manager</span>
	</a>
	<!-- Card -->
	<div class="w-full max-w-md p-6 space-y-8 sm:p-8 bg-white rounded-lg shadow dark:shadow-transparent dark:bg-gray-900/50">
		<h2 class="text-2xl font-bold text-gray-900 dark:text-white">
			Connectez-vous
		</h2>
		<?php
		include('partials/messages/messageAction.php');
		?>
		<form class="mt-8 space-y-6" action="/user/action" method="POST">
			<?php
			include("components/form.php");
			inputFormGroupLabel('Username', 'text', 'userName', 'userName', 'JohnDoe', true);
			inputFormGroupLabel('Mot de passe', 'password', 'password', 'password', '*******', true);
			inputHidden('action_type', 'login-user');
			?>

			<button type="submit" class="w-full px-5 py-3 text-sm font-medium text-center text-white bg-primary-700 rounded-lg hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 sm:w-auto dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
				Se connecter
			</button>
		</form>
	</div>
</div>
