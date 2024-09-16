<?php
	require_once('components/bghelper.php');
function badge($text, $type = "info")
{
	$bg = getBadgeAlertBg($type);

?>
	<span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium <?= $bg ?>">
		<?= $text ?>
	</span>
<?php
}
?>
