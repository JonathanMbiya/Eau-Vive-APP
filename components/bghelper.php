<?php
function getBadgeAlertBg($type)
{
	$bg = '';
	switch ($type) {
		case 'info':
			$bg = 'bg-teal-100 text-teal-800 dark:bg-teal-800/30 dark:text-teal-500';
			break;
		case 'success':
			$bg = 'bg-success-100 text-success-800 dark:bg-success-800/30 dark:text-success-500';
			break;
		case 'warning':
			$bg = 'bg-yellow-100 text-yellow-800 dark:bg-yellow-800/30 dark:text-yellow-500';
			break;
		case 'danger':
			$bg = 'bg-red-100 text-red-800 dark:bg-red-800/30 dark:text-red-500';
			break;
		default:
			$bg = 'bg-gray-100 text-gray-800 dark:bg-white/10 dark:text-white';
			break;
	}

	return $bg;
}
