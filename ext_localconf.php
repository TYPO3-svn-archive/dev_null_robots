<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['tslib/class.tslib_fe.php']['configArrayPostProc'][$_EXTKEY] = 'EXT:dev_null_robots/class.tx_devnullrobots_fehook.php:&tx_devnullrobots_fehook->hookInitConfig';

?>