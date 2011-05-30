<?php
/**
 * @package		NewLifeInIT
 * @subpackage	com_artofgm
 * @copyright	Copyright 2011 New Life in IT Pty Ltd. All rights reserved.
 * @license		GNU General Public License version 2 or later.
 */

// No direct access
defined('_JEXEC') or die;

class ArtofGMHelperHttp
{
	/**
	 * @var		JHTTP	The HTTP Connector.
	 * @since	1.0
	 */
	protected static $http = null;

	/**
	 * Gets the HTTP connector.
	 *
	 * @param	array	An optional array of options for the connector.
	 *
	 * @return	JHTTP
	 * @since	1.0
	 * @throw	Exception
	 */
	public static function getHttpConnector($httpOptions = array())
	{
		juimport('joomla.client.http');

		if (empty(self::$http)) {
			$params			= JComponentHelper::getParams('com_artofgm');
			$httpType		= $params->get('dl_method', 'fopen');

			// Add options if proxy is enabled.
			if ($params->get('proxy')) {
				if (!isset($httpOptions['proxy_host'])) {
					$httpOptions['proxy_host'] = $params->get('dl_proxy_host');
				}

				if (!isset($httpOptions['proxy_port'])) {
					$httpOptions['proxy_port'] = $params->get('dl_proxy_post');
				}

				if (!isset($httpOptions['proxy_user'])) {
					$httpOptions['proxy_user'] = $params->get('dl_proxy_user');
				}

				if (!isset($httpOptions['proxy_pass'])) {
					$httpOptions['proxy_pass'] = $params->get('dl_proxy_pass');
				}
			}

			self::$http = JHTTP::getInstance($httpType, $httpOptions);
		}

		return self::$http;
	}

	/**
	 * Gets the contents of a URL.
	 *
	 * @return	string
	 * @throws	Exception
	 */
	public static function getUrl($url)
	{
		// TODO Add second argument to accept a filename.

		$data = self::getHttpConnector()->get($url);

		return $data;
	}
}