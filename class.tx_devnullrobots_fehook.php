<?php

/***************************************************************
*  Copyright notice
*  
*  (c) 2011 Wolfgang Rotschek <scotty@dev-null.at>
*  All rights reserved
*
*  This script is part of the Typo3 project. The Typo3 project is 
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


class tx_devnullrobots_fehook {    

	public function hookInitConfig(array &$parameters, tslib_fe &$parentObject) {
		
		$meta = array(
			1 => 'index',
			2 => 'follow'
		);
		
		$TSconf = &$parameters['config'];
		$fePage  = &$parentObject;
		
		if($TSconf['devnullrobots.']['metaRobots'] == 0)
			return;
		
		// merge SETUP with page data
		$flag = $TSconf['devnullrobots.']['metaDefault'] | $fePage->page['tx_devnullrobots_flags'];
		
		if ($flag & 1) {
			$meta[1] = 'noindex';
        }

		if ($flag & 2) {
			$meta[2] = 'nofollow';
		}
		
		// add the meta header
		$GLOBALS['TSFE']->additionalHeaderData[] = '<meta name="robots" content="' . implode(',', $meta) . '" />';
		
    }	
}

if (defined("TYPO3_MODE") && $TYPO3_CONF_VARS[TYPO3_MODE]["XCLASS"]["ext/dev_null_robots/class.tx_devnullrobots_fehook.php"]){
        include_once($TYPO3_CONF_VARS[TYPO3_MODE]["XCLASS"]["ext/dev_null_robots/class.tx_devnullrobots_fehook.php"]);
}

?>
