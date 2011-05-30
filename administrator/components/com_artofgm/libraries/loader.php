<?php
/**
 * @package		NewLifeInIT
 * @subpackage	com_artofpdf
 * @copyright	Copyright 2005 - 2011 New Life in IT Pty Ltd. All rights reserved.
 * @license		GNU General Public License version 2 or later.
 * @link		http://www.theartofjoomla.com
 * @author		Andrew Eddie <support@theartofjoomla.com>
 */

// no direct access
defined('_JEXEC') or die;

/**
 * Replacement for jimport that falls back to jimport.
 *
 * @param	string	$path	The library path.
 *
 * @return
 * @since	1.0
 * @author	Sam Moffat
 */
function juimport($path)
{
	// Attempt to load the path locally but...
	// Unfortunately 1.5 doesn't check the file exists before including it so we mask it
	$res = JLoader::import($path, dirname(__FILE__));

	if (!$res) {
		// fall back when it doesn't work
		return jimport($path);
	}

	return $res;
}

if (!function_exists('jximport')) {
	/**
	 * Proxy for juimport function.
	 *
	 * @param	string	$path	The library path.
	 *
	 * @return
	 * @since	1.0
	 */
	function jximport($path)
	{
		return juimport($path);
	}
}
