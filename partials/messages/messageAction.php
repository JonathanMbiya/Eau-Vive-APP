<?php
function AlertMessage($message, $type)
{
?>
	<div class="mb-6">
		<div class="alert alert-fill alert-danger alert-icon">
			<em class="icon ni ni-alert-circle"></em>
			<strong>
				<?= $message ?>
			</strong>
		</div>
	</div>
<?php
}

if (isset($_SESSION['sessData']) && !empty($_SESSION['sessData']['status']) && $_SESSION['sessData']['status']['type'] == 'danger') {
	AlertMessage($_SESSION['sessData']['status']['msg'], 'danger');
	$_SESSION['sessData']['status'] = [];
} elseif (isset($_SESSION['sessData']) && !empty($_SESSION['sessData']['status']) && $_SESSION['sessData']['status']['type'] == 'success') {
	AlertMessage($_SESSION['sessData']['status']['msg'], 'success');
	$_SESSION['sessData']['status'] = [];
} elseif (isset($_SESSION['sessData']) && !empty($_SESSION['sessData']['status']) && $_SESSION['sessData']['status']['type'] == 'warning') {
	AlertMessage($_SESSION['sessData']['status']['msg'], 'warning');
	$_SESSION['sessData']['status'] = [];
}
?>
