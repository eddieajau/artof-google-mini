<?php
/**
 * @package		NewLifeInIT
 * @subpackage	com_artofgm
 * @copyright	Copyright 2011 New Life in IT Pty Ltd. All rights reserved
 * @license		GNU General Public License <http://www.fsf.org/licensing/licenses/gpl.html>
 * @link		http://www.theartofjoomla.com
 */

// No direct access.
defined('_JEXEC') or die;

// Load the component language file
$language = JFactory::getLanguage();
$language->load('com_redirect');

// Include dependancies.
require_once dirname(__FILE__).'/helper.php';
require_once dirname(dirname(__FILE__)).'/version.php';

// Uninstall the modules.
$modules = PackageInstallerHelper::uninstallModules($this);
if ($modules === false) {
	return false;
}

// Uninstall the plugins.
$plugins = PackageInstallerHelper::uninstallPlugins($this);
if ($plugins === false) {
	return false;
}

// Display the results.
PackageInstallerHelper::displayInstalled(
	$modules,
	$plugins,
	JText::_('COM_ARTOFGM_UNINSTALLED'),
	JText::_('COM_ARTOFGM')
);
