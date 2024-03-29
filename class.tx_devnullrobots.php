<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2011 Wolfgang <scotty@dev-null.at>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/
/**
 * [CLASS/FUNCTION INDEX of SCRIPT]
 *
 * Hint: use extdeveval to insert/update function index above.
 */

require_once(PATH_tslib.'class.tslib_pibase.php');


/**
 * Plugin 'Robots.txt' for the 'dev_null_robots' extension.
 *
 * @author	Wolfgang <scotty@dev-null.at>
 * @package	TYPO3
 * @subpackage	tx_devnullrobots
 */
class tx_devnullrobots {

	var $conf;
	
	/**
	 * The main method of the PlugIn
	 *
	 * @param	string		$content: The PlugIn content
	 * @param	array		$conf: The PlugIn configuration
	 * @return	The content that is displayed on the website
	 */
	function main($content, $conf)	{
		$domain = t3lib_div::getIndpEnv('TYPO3_HOST_ONLY');
		$sitemap = FALSE;
		
		// ignore passed $conf and get the whole config for use tx_devnullrobots
		$this->conf = $GLOBALS['TSFE']->tmpl->setup['config.']['devnullrobots.'];

		$content = array(
			'# robots.txt',
			'# '.$domain
		);

		// get rootline
		$rootline = $GLOBALS['TSFE']->sys_page->getRootLine($GLOBALS['TSFE']->id);

		// walk down root line to first siteroot
		// this page must hold the domain records
		foreach($rootline as $key => $page) {
			if($page['is_siteroot']) {
				$rootUid = $page['uid'];
				break;
			}
		}

		// build query to access page content
		// and ensure link between doamin and page
		$selectClause = array(
			'pid = ' . $rootUid,						// page holding domain record
			'domainName = "' . $domain . '"',			// domain name
		);

		$dbRes = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', 'sys_domain', implode(' AND ', $selectClause));
		
		if($rowDomain = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($dbRes)) {
			// get configurations
			$cCfg = explode(',', $rowDomain['tx_devnullrobots_crawler']);
			
			// for each possible crawler
			foreach($cCfg as $cUID) {
				// build query to access crawler content
				$dbRobot = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', 'tx_devnullrobots_crawlercfg', "uid = $cUID");
				
				// t3lib_utility_Debug::debug("uid = $cUID", $cUID);
				
				if($rowRobot = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($dbRobot)) {
					$content[] = '';
					$content[] = 'User-agent: ' . $rowRobot['useragent'];
					$content[] = $rowRobot['crawlercfg'];
				}
			}
			
			if($rowDomain['tx_devnullrobots_default']) {
				// we have domain depending default configuration
				$content[] = '';
				$content[] = 'User-agent: *';
				$content[] = $rowDomain['tx_devnullrobots_default'];
				
				$this->conf['useDefault'] = '';
			}

			if($rowDomain['tx_devnullrobots_sitemap']) {
				$sitemap = TRUE;
			}
		}
		
		switch($this->conf['useDefault']) {
			case 'allow':
				$content[] = '';
				$content[] = $this->conf['defaultRules.']['defaultAllow'];
				break;
			case 'disallow':
				$content[] = '';
				$content[] = $this->conf['defaultRules.']['defaultDisallow'];
				break;
		}

		if($sitemap) {
			$content[] = '';
			$content[] = 'Sitemap: http://' . $domain . '/' . $this->conf['sitemapName'];
		}
		
		return implode("\n", $content);
	}
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/dev_null_robots/class.tx_devnullrobots.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/dev_null_robots/class.tx_devnullrobots.php']);
}

?>