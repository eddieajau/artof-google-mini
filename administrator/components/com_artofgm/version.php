<?php
/**
 * @package		NewLifeInIT
 * @subpackage	com_artofgm
 * @copyright	Copyright 2011 New Life in IT Pty Ltd. All rights reserved.
 * @license		GNU General Public License <http://www.fsf.org/licensing/licenses/gpl.html>
 * @link		http://www.theartofjoomla.com
 */

// No direct access.
defined('_JEXEC') or die;

/**
 * @package		NewLifeInIT
 * @subpackage	com_artofgm
 */
class ArtofGMVersion
{
	/**
	 * Extension name string.
	 *
	 * @var		string
	 */
	const EXTENSION	= 'com_artofgm';

	/**
	 * Major.Minor version string.
	 *
	 * @var		string
	 */
	const VERSION	= '1.0';

	/**
	 * Maintenance version string.
	 *
	 * @var		string
	 */
	const SUBVERSION= '1';

	/**
	 * Version status string.
	 *
	 * @var		string
	 */
	const STATUS	= '';

	/**
	 * Version release time stamp.
	 *
	 * @var		string
	 */
	const DATE		= '2011-03-16 00:00:00';

	/**
	 * Source control revision string.
	 *
	 * @var		string
	 */
	const REVISION	= '0';

	/**
	 * Method to get the build number from the source control revision string.
	 *
	 * @return	integer	The version build number.
	 * @since	1.0
	 */
	public static function getBuild()
	{
		return intval(substr(self::REVISION, 11));
	}

	/**
	 * Gets the version number.
	 *
	 * @param	boolean	$build	Optionally show the build number.
	 * @param	boolean	$status	Optionally show the status string.
	 *
	 * @return	string
	 * @since	1.0.3
	 */
	public static function getVersion($build = false, $status = false)
	{
		$text = self::VERSION.'.'.self::SUBVERSION;

		if ($build) {
			$text .= ':'.self::getBuild();
		}

		if ($status) {
			$text .= ' '.self::STATUS;
		}

		return $text;
	}
}