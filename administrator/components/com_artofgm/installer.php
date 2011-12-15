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
 * Installer class.
 *
 * @package     NewLifeInIT
 * @subpackage  com_artofgm
 * @since       1.0.1
 */
class Com_ArtofGMInstallerScript
{
	/**
	 * Runs after files are installed and database scripts executed.
	 *
	 * @param   JInstaller  $parent  The installer object.
	 *
	 * @return  void
	 *
	 * @since   1.0.1
	 */
	public function install($parent)
	{
		// Add custom code.
	}

	/**
	 * Runs after files are removed and database scripts executed.
	 *
	 * @param   JInstaller  $parent  The installer object.
	 *
	 * @return  void
	 *
	 * @since   1.0.1
	 */
	public function uninstall($parent)
	{
		// Add custom code.
	}

	/**
	 * Runs after files are updated and database scripts executed.
	 *
	 * @param   JInstaller  $parent  The installer object.
	 *
	 * @return  void
	 *
	 * @since   1.0.1
	 */
	public function update($parent)
	{
		// Add custom code.
	}

	/**
	 * Runs before anything is run.
	 *
	 * @param   string      $type    The type of installation: install|update.
	 * @param   JInstaller  $parent  The installer object.
	 *
	 * @return  void
	 *
	 * @since   1.0.1
	 */
	public function preflight($type, $parent)
	{
		// Add custom code.
	}

	/**
	 * Runs after an extension install or update.
	 *
	 * @param   string      $type    The type of installation: install|update.
	 * @param   JInstaller  $parent  The installer object.
	 *
	 * @return  void
	 *
	 * @since   1.0.1
	 */
	public function postflight($type, $parent)
	{
		// Note: this file is executed in the tmp folder.
		require_once dirname(__FILE__) . '/admin/version.php';

		if ($type == 'install')
		{
			echo JText::sprintf('COM_ARTOFGM_INSTALLED1', ArtofGMVersion::getVersion(false, true));
		}
		else
		{
			echo JText::sprintf('COM_ARTOFGM_INSTALLED2', ArtofGMVersion::getVersion(false, true));
		}
	}
}
