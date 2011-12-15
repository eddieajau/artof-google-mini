<?php
/**
 * @package     NewLifeInIT
 * @subpackage  com_artofgm
 * @copyright   Copyright 2011 New Life in IT Pty Ltd. All rights reserved.
 * @license     GNU General Public License <http://www.fsf.org/licensing/licenses/gpl.html>
 * @link        http://www.theartofjoomla.com
 */

// No direct access.
defined('_JEXEC') or die;

/**
 * Extension version class.
 *
 * @package     NewLifeInIT
 * @subpackage  com_artofgm
 * @since       1.0
 */
class ArtofGMVersion
{
	/**
	 * Extension name string.
	 *
	 * @var    string
	 * @since  1.0
	 */
	const EXTENSION = 'com_artofgm';

	/**
	 * Major.Minor version string.
	 *
	 * @var    string
	 * @since  1.0
	 */
	const VERSION = '1.0';

	/**
	 * Maintenance version string.
	 *
	 * @var    string
	 * @since  1.0
	 */
	const SUBVERSION = '1';

	/**
	 * Version status string.
	 *
	 * @var    string
	 * @since  1.0
	 */
	const STATUS = '';

	/**
	 * Version release time stamp.
	 *
	 * @var    string
	 * @since  1.0
	 */
	const DATE = '2011-12-15 00:00:00';

	/**
	 * Source control revision string.
	 *
	 * @var    string
	 * @since  1.0
	 */
	const REVISION = '0';

	/**
	 * Method to get the build number from the source control revision string.
	 *
	 * @return  integer  The version build number.
	 *
	 * @since   1.0
	 */
	public static function getBuild()
	{
		return intval(substr(self::REVISION, 11));
	}

	/**
	 * Gets the version number.
	 *
	 * @param   boolean  $build   Optionally show the build number.
	 * @param   boolean  $status  Optionally show the status string.
	 *
	 * @return  string
	 *
	 * @since   1.0.3
	 */
	public static function getVersion($build = false, $status = false)
	{
		$text = self::VERSION . '.' . self::SUBVERSION;

		if ($build)
		{
			$text .= ':' . self::getBuild();
		}

		if ($status)
		{
			$text .= ' ' . self::STATUS;
		}

		return $text;
	}
}
