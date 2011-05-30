<?php
/**
 * @package		Jentla
 * @subpackage	com_jentlacert
 * @copyright	Copyright 2011 New Life in IT Pty Ltd. All rights reserved.
 * @copyright	Copyright 2010 Jentla Pty Ltd. All rights reserved.
 * @license		GNU General Public License version 2 or later.
 * @link		http://www.jentla.com
 * @author		Andrew Eddie <andrew.eddie@newlifeinit.com>
 */

// no direct access
defined('_JEXEC') or die;

/**
 * @package		Jentla
 * @subpackage	com_jentlacert
 * @since		1.0
 */
class JHTTPfopen extends JHTTP
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
		$httpOptions = array(
			'method'		=> 'GET',
			'user_agent'	=> 'Mozilla/5.0'
		);

		if ($this->proxy_host) {
			$httpOptions['proxy'] = 'tcp://'.$this->proxy_host.':'.$this->proxy_port;
			// Play nicely with squid
			$httpOptions['request_fulluri'] = 'true';

			if ($this->proxy_user) {
				$credentials = base64_encode($this->proxy_user.':'.$this->proxy_pass);
				$httpOptions['header'] .= "Proxy-Authorization: Basic $credentials\r\n";
			}
		}

		if ($this->timeout) {
			$httpOptions['timeout'] = $this->timeout;
		}

		$context = stream_context_create(
			array(
				'http'	=> $httpOptions
			)
		);

		// Reset the error message variable.
		$php_errormsg = '';

		// Set track errors.
		$track_errors = ini_set('track_errors',true);

		$buffer = @file_get_contents($url, false, $context);

		// Reset track errors.
		ini_set('track_errors',$track_errors);

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