<?php
/**
 * @package     NewLifeInIT
 * @subpackage  com_artofgm
 * @copyright   Copyright 2011 New Life in IT Pty Ltd. All rights reserved.
 * @license     GNU General Public License version 2 or later.
 */

// No direct access
defined('_JEXEC') or die;

/**
 * HTTP helper.
 *
 * @package     NewLifeInIT
 * @subpackage  com_artofgm
 * @since       1.0
 */
class ArtofGMHelperHttp
{
	/**
	 * @var    JHTTP	The HTTP Connector.
	 * @since   1.0
	 */
	protected static $http = null;

	/**
	 * Gets the HTTP connector.
	 *
	 * @param   array  $httpOptions  An optional array of options for the connector.
	 *
	 * @return  JHttp
	 *
	 * @since   1.0
	 * @throw	Exception
	 */
	public static function getHttpConnector($httpOptions = array())
	{
		if (empty(self::$http))
		{
			$params = JComponentHelper::getParams('com_artofgm');
			$httpType = $params->get('dl_method', 'fopen');

			// Add options if proxy is enabled.
			if ($params->get('proxy'))
			{
				if (!isset($httpOptions['proxy_host']))
				{
					$httpOptions['proxy_host'] = $params->get('dl_proxy_host');
				}

				if (!isset($httpOptions['proxy_port']))
				{
					$httpOptions['proxy_port'] = $params->get('dl_proxy_post');
				}

				if (!isset($httpOptions['proxy_user']))
				{
					$httpOptions['proxy_user'] = $params->get('dl_proxy_user');
				}

				if (!isset($httpOptions['proxy_pass']))
				{
					$httpOptions['proxy_pass'] = $params->get('dl_proxy_pass');
				}
			}

// 			self::$http = JHttp::getInstance($httpType, $httpOptions);
			self::$http = new JHttp;
		}

		return self::$http;
	}

	/**
	 * Gets the contents of a URL.
	 *
	 * @param   string  $url  The url.
	 *
	 * @return  string
	 *
	 * @since   1.0
	 * @throws  Exception
	 */
	public static function getUrl($url)
	{
		// TODO Add second argument to accept a filename.

		$data = self::getHttpConnector()->get($url);

		return $data->body;
	}
}
