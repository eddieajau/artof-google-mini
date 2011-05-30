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
abstract class JHTTP
{
	/**
	 * @var		array	Connector options.
	 * @since	1.0
	 */
	protected $options = array();

	/**
	 * Magic get method.
	 *
	 * @param	string	$name	The name of the property
	 *
	 * @return	mixed	The value of the property or proxy or null if not found.
	 * @throws	Exception
	 */
	protected function __get($name)
	{
		switch ($name)
		{
			case 'proxy_host':
			case 'proxy_port':
			case 'proxy_user':
			case 'proxy_pass':
			case 'timeout':
				if (isset($this->options[$name])) {
					return trim($this->options[$name]);
				}
				break;

			default:
				throw new Exception('Undefined property via __get: '.$name);
				break;
		}

		return null;
	}

	/**
	 * Get an instance of a HTTP connector class.
	 *
	 * @param	string	$type		The type of HTTP connector: fopen|curl
	 * @param	array	$options	Options for the connector.
	 *
	 * @return	JHTTP	An instance of a JHTTP derived class.
	 * @throws	Exception
	 */
	public function getInstance($type = 'fopen', $options = array())
	{
		static $instances;

		if (!isset($instances)) {
			$instances = array();
		}

		$type		= preg_replace('/[^A-Z0-9_\.-]/i', '', $type);
		$signature	= $type.serialize($options);

		if (empty($instances[$signature])) {
			// Check if the user has preloaded a custom type.
			$className	= 'JHTTP'.$type;

			if (!class_exists($className)) {
				$path = dirname(__FILE__).'/http/'.$type.'.php';

				if (file_exists($path)) {
					require_once $path;

					// Just check again to see if the class loaded.
					if (!class_exists($className)) {
						throw new Exception(JText::sprintf('JLIB_ERROR_HTTP_ADAPTER_UNAVAILABLE', $type));
					}
				}
				else {
					throw new Exception(JText::sprintf('JLIB_ERROR_HTTP_ADAPTER_UNAVAILABLE', $type));
				}
			}

			// Constructor can throw an exception if there is a problem.
			$instance = new $className($options);

			$instances[$signature] = $instance;
		}

		return $instances[$signature];
	}
}