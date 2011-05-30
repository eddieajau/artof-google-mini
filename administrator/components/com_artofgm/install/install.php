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
$language->load('com_artofgm', JPATH_ADMINISTRATOR.'/components/com_artofgm');

// PHP 5 check
if (version_compare(PHP_VERSION, '5.2.4', '<')) {
	$this->parent->abort(JText::_('J_USE_PHP5'));
	return false;
}

// Include dependancies.
require_once dirname(__FILE__).'/helper.php';
require_once dirname(dirname(__FILE__)).'/version.php';

// Install the modules.
$modules = PackageInstallerHelper::installModules($this);
if ($modules === false) {
	return false;
}

// Install the plugins.
$plugins = PackageInstallerHelper::installPlugins($this);
if ($plugins === false) {
	return false;
}

// Display the results.
PackageInstallerHelper::displayInstalled(
	$modules,
	$plugins,
	JText::sprintf('COM_ARTOFGM_INSTALLED', ArtofGMVersion::getVersion(false, true)),
	JText::_('ARTOFGM')
);
