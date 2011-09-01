<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

t3lib_extMgm::allowTableOnStandardPages('tx_devnullrobots_crawlercfg');

$TCA['tx_devnullrobots_crawlercfg'] = array (
	'ctrl' => array (
		'title'     => 'LLL:EXT:dev_null_robots/locallang_db.xml:tx_devnullrobots_crawlercfg',		
		'label'     => 'useragent',	
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'sortby' => 'sorting',	
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_devnullrobots_crawlercfg.gif',
	),
);

$tempColumns = array (
	'tx_devnullrobots_crawler' => array (		
		'exclude' => 0,		
		'label' => 'LLL:EXT:dev_null_robots/locallang_db.xml:sys_domain.tx_devnullrobots_crawler',		
		'config' => array (
			'type' => 'group',	
			'internal_type' => 'db',	
			'allowed' => 'tx_devnullrobots_crawlercfg',	
			'size' => 4,	
			'minitems' => 0,
			'maxitems' => 100,
		)
	),
	'tx_devnullrobots_default' => array (		
		'exclude' => 0,		
		'label' => 'LLL:EXT:dev_null_robots/locallang_db.xml:sys_domain.tx_devnullrobots_default',		
		'config' => array (
			'type' => 'text',
			'cols' => '30',	
			'rows' => '8',
		)
	),
);


t3lib_div::loadTCA('sys_domain');
t3lib_extMgm::addTCAcolumns('sys_domain',$tempColumns,1);
t3lib_extMgm::addToAllTCAtypes('sys_domain','tx_devnullrobots_crawler;;;;1-1-1, tx_devnullrobots_default');
?>