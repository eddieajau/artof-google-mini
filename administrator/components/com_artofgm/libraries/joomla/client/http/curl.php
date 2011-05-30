<?php
/**
 * @package		Joomla.Framework
 * @subpackage	HTTP
 * @copyright	Copyright 2011 New Life in IT Pty Ltd. All rights reserved.
 * @license		GNU General Public License version 2 or later.
 * @link		http://www.theartofjoomla.com
 * @author		Andrew Eddie <andrew.eddie@newlifeinit.com>
 */

// no direct access
defined('_JEXEC') or die;

/**
 * @package		Jentla
 * @subpackage	com_jentlacert
 * @since		1.0
 */
class JHTTPcurl extends JHTTP
{
	/**
	 * Get a URL via the fopen method.
	 *
	 * @param	string	$url		The URL to get.
	 * @param	string	$fileName	TODO (the file to save the buffer).
	 *
	 * @return	string	Returns a buffer if no filename specified.
	 * @since	1.0
	 */
	public function get($url, $fileName = '')
	{
		if (!function_exists('curl_init')) {
			throw new Exception(JText::_('JLIB_ERROR_CURL_UNSUPPORTED'));
		}

		// Set up the user agent.
		if (empty($this->user_agent)) {
			$ua = 'Mozilla/5.0';
		}
		else {
			$ua = $this->user_agent;
		}

		// Reset the error message variable.
		$php_errormsg = '';

		// Set track errors.
		$track_errors = ini_set('track_errors',true);

		// Create a new cURL resource
		$ch = curl_init();

		//
		// Set URL and other appropriate options
		//

		// Set the download URL
		curl_setopt($ch, CURLOPT_URL,		$url);

		// Don't include the header in the output
		curl_setopt($ch, CURLOPT_HEADER,	false);

		// Set the user agent
		curl_setopt($ch, CURLOPT_USERAGENT, $ua);

		// follow redirects (required for Joomla!)
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

		// 10 maximum redirects
		curl_setopt($ch, CURLOPT_MAXREDIRS, 10);

		// We only want the result, not the output.
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		$buffer = curl_exec($ch);
		curl_close($ch);

		if ($buffer === false) {
			throw new Exception(
				"Failed to connect to URL: $url".
				"\nError: $php_errormsg".
				($this->proxy_host ? "\nUsing proxy" : '')
			);
		}

		ini_set('track_errors', $track_errors);

		return $buffer;
	}
}