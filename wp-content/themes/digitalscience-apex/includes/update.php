<?php

/* --------------------------------------------------------- */
/* !Auto updater script - 1.0.0 */
/* --------------------------------------------------------- */

//Initialize the update checker.
require 'theme-updates/theme-update-checker.php';
$MyUpdateChecker = new ThemeUpdateChecker(
	'digitalscience-apex',
	'http://www.metaphorcreations.com/envato/themes/apex/auto-update.json'
);
//$MyUpdateChecker->checkForUpdates();
