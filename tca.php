<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_devnullrobots_crawlercfg'] = array (
	'ctrl' => $TCA['tx_devnullrobots_crawlercfg']['ctrl'],
	'interface' => array (
		'showRecordFieldList' => 'useragent,crawlercfg'
	),
	'feInterface' => $TCA['tx_devnullrobots_crawlercfg']['feInterface'],
	'columns' => array (
		'useragent' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:dev_null_robots/locallang_db.xml:tx_devnullrobots_crawlercfg.useragent',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',	
				'max' => '30',	
				'eval' => 'required,trim',
			)
		),
		'crawlercfg' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:dev_null_robots/locallang_db.xml:tx_devnullrobots_crawlercfg.crawlercfg',		
			'config' => array (
				'type' => 'text',
				'cols' => '30',	
				'rows' => '16',
			)
		),
	),
	'types' => array (
		'0' => array('showitem' => 'useragent;;;;1-1-1, crawlercfg')
	),
	'palettes' => array (
		'1' => array('showitem' => '')
	)
);
?>