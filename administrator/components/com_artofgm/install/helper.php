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

/**
 * Installation helper.
 *
 * Changelog:
 * + Modules won't be added to the table if they exist already.
 * + Added showtitle attribute for modules.
 * + Added published attribute for modules.
 *
 * @package		NewLifeInIT
 * @subpackage	com_artofgm
 * @version		1.0.1
 */
abstract class PackageInstallerHelper
{
	/**
	 * Display the results of the package install.
	 *
	 * @param	array	$modules	An array of the modules that were installed.
	 * @param	array	$plugins	An array of the plugins that were installed.
	 * @param	string	$title		The page title.
	 * @param	string	$name		The name of the component.
	 *
	 * @return	void
	 * @since	1.0
	 */
	public static function displayInstalled(&$modules, &$plugins, $title, $name)
	{
?>
<?php echo $title;?>

<table class="adminlist">
	<thead>
		<tr>
			<th class="title" colspan="2"><?php echo JText::_('J_INSTALL_EXTENSION'); ?></th>
			<th width="30%"><?php echo JText::_('J_INSTALL_STATUS'); ?></th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<td colspan="3"></td>
		</tr>
	</tfoot>
	<tbody>
		<tr class="row0">
			<td class="key" colspan="2"><?php echo JText::sprintf('J_INSTALL_COMPONENT', $name); ?></td>
			<td><strong><?php echo JText::_('J_INSTALL_INSTALLED'); ?></strong></td>
		</tr>
<?php if ($modules) : ?>
		<tr>
			<th><?php echo JText::_('J_INSTALL_MODULE'); ?></th>
			<th><?php echo JText::_('J_INSTALL_CLIENT'); ?></th>
			<th></th>
		</tr>
	<?php foreach ($modules as $i => $module) : ?>
		<tr class="row<?php echo ($i % 2); ?>">
			<td class="key"><?php echo $module['name']; ?></td>
			<td class="key"><?php echo ucfirst($module['client']); ?></td>
			<td><strong><?php echo JText::_('J_INSTALL_INSTALLED'); ?></strong></td>
		</tr>
	<?php endforeach;
endif;
if ($plugins) : ?>
		<tr>
			<th><?php echo JText::_('J_INSTALL_PLUGIN'); ?></th>
			<th><?php echo JText::_('J_INSTALL_GROUP'); ?></th>
			<th></th>
		</tr>
	<?php foreach ($plugins as $i => $plugin) : ?>
		<tr class="row<?php echo ($i % 2); ?>">
			<td class="key"><?php echo ucfirst($plugin['name']); ?></td>
			<td class="key"><?php echo ucfirst($plugin['group']); ?></td>
			<td><strong><?php echo JText::_('J_INSTALL_INSTALLED'); ?></strong></td>
		</tr>
	<?php endforeach;
endif; ?>
	</tbody>
</table>
<?php
	}

	/**
	 * Display the results of the package uninstall.
	 *
	 * @param	array	$modules	An array of the modules that were installed.
	 * @param	array	$plugins	An array of the plugins that were installed.
	 * @param	string	$title		The page title.
	 * @param	string	$name		The name of the component.
	 *
	 * @return	void
	 * @since	1.0
	 */
	public static function displayUninstalled(&$modules, &$plugins, $title, $name)
	{
?>
<h2><?php echo $title;?></h2>
<table class="adminlist">
	<thead>
		<tr>
			<th class="title" colspan="2"><?php echo JText::_('J_INSTALL_EXTENSION'); ?></th>
			<th width="30%"><?php echo JText::_('J_INSTALL_STATUS'); ?></th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<td colspan="3"></td>
		</tr>
	</tfoot>
	<tbody>
		<tr class="row0">
			<td class="key" colspan="2"><?php echo JText::sprintf('J_INSTALL_COMPONENT', $name); ?></td>
			<td><strong><?php echo JText::_('J_INSTALL_REMOVED'); ?></strong></td>
		</tr>
<?php if ($modules) : ?>
		<tr>
			<th><?php echo JText::_('J_INSTALL_MODULE'); ?></th>
			<th><?php echo JText::_('J_INSTALL_CLIENT'); ?></th>
			<th></th>
		</tr>
	<?php foreach ($modules as $i => $module) : ?>
		<tr class="row<?php echo ($i % 2); ?>">
			<td class="key"><?php echo $module['name']; ?></td>
			<td class="key"><?php echo ucfirst($module['client']); ?></td>
			<td><strong><?php echo JText::_('J_INSTALL_REMOVED'); ?></strong></td>
		</tr>
	<?php endforeach;
endif;
if ($plugins) : ?>
		<tr>
			<th><?php echo JText::_('J_INSTALL_PLUGIN'); ?></th>
			<th><?php echo JText::_('J_INSTALL_GROUP'); ?></th>
			<th></th>
		</tr>
	<?php foreach ($plugins as $i => $plugin) : ?>
		<tr class="row<?php echo ($i % 2); ?>">
			<td class="key"><?php echo ucfirst($plugin['name']); ?></td>
			<td class="key"><?php echo ucfirst($plugin['group']); ?></td>
			<td><strong><?php echo JText::_('J_INSTALL_REMOVED'); ?></strong></td>
		</tr>
	<?php endforeach;
endif; ?>
	</tbody>
</table>
<?php
	}

	/**
	 * Fixes a bug in the components table for backend only extensions.
	 *
	 * @param	string	$option	The name of the component folder.
	 *
	 * @return	void
	 * @since	1.0
	 */
	public static function fixLink($option)
	{
		// Insert a new installation record in the version log if no rows are present.
		$db	= JFactory::getDBO();

		// Correct bug in components table for backend only extenions

		$db->setQuery(
			'UPDATE `#__components` SET `link` = '.$db->quote('').' WHERE `option` = '.$db->quote($option)
		);

		if (!$db->query()) {
			JError::raiseWarning(500, $db->getErrorMsg());
		}
	}

	/**
	 * Install packaged modules.
	 *
	 * @param	object	$installer	The parent installer object.
	 *
	 * @return	array	An array of the installed modules.
	 * @since	1.0
	 */
	public static function installModules(&$installer)
	{
		$result		= array();
		$modules	= &$installer->manifest->getElementByPath('modules');

		if (is_a($modules, 'JSimpleXMLElement') && count($modules->children())) {
			foreach ($modules->children() as $module)
			{
				$mname		= $module->attributes('module');
				$mclient	= JApplicationHelper::getClientInfo($module->attributes('client'), true);

				// Set the installation path
				if (!empty ($mname)) {
					$installer->parent->setPath('extension_root', $mclient->path.'/modules/'.$mname);
				}
				else {
					$installer->parent->abort(JText::_('J_Install_Module').' '.JText::_('J_INSTALL_INSTALL').': '.JText::_('J_INSTALL_MODULE_FILE_MISSING'));
					return false;
				}

				// If the module directory already exists, then we will assume that the
				// module is already installed or another module is using that directory.
				if (file_exists($installer->parent->getPath('extension_root'))&&!$installer->parent->getOverwrite()) {
					$installer->parent->abort(JText::_('J_Install_Module').' '.JText::_('J_INSTALL_INSTALL').': '.JText::sprintf('J_INSTALL_MODULE_PATH_CONFLICT', $installer->parent->getPath('extension_root')));
					return false;
				}

				// If the module directory does not exist, lets create it
				$created = false;
				if (!file_exists($installer->parent->getPath('extension_root'))) {
					if (!$created = JFolder::create($installer->parent->getPath('extension_root'))) {
						$installer->parent->abort(JText::_('J_Install_Module').' '.JText::_('J_INSTALL_INSTALL').': '.JText::sprintf('J_INSTALL_MODULE_PATH_CREATE_FAILURE', $installer->parent->getPath('extension_root')));
						return false;
					}
				}

				// Since we created the module directory and will want to remove it if
				// we have to roll back the installation, lets add it to the
				// installation step stack
				if ($created) {
					$installer->parent->pushStep(array ('type' => 'folder', 'path' => $installer->parent->getPath('extension_root')));
				}

				// Copy all necessary files
				$element = &$module->getElementByPath('files');
				if ($installer->parent->parseFiles($element, -1) === false) {
					// Install failed, roll back changes
					$installer->parent->abort();
					return false;
				}

				// Copy language files
				$element = &$module->getElementByPath('languages');
				if ($installer->parent->parseLanguages($element, $mclient->id) === false) {
					// Install failed, roll back changes
					$installer->parent->abort();
					return false;
				}

				// Copy media files
				$element = &$module->getElementByPath('media');
				if ($installer->parent->parseMedia($element, $mclient->id) === false) {
					// Install failed, roll back changes
					$installer->parent->abort();
					return false;
				}

				$mtitle		= $module->attributes('title');
				$mposition	= $module->attributes('position');
				$mShowTitle	= $module->attributes('showtitle');
				$mPublished	= $module->attributes('published');

				if ($mtitle && $mposition) {
					// Check if module is already installed.
					$db = JFactory::getDBO();
					$db->setQuery(
						'SELECT id' .
						' FROM #__modules' .
						' WHERE client_id = '.(int) $mclient->id.
						'  AND module = '.$db->quote($mname)
					);
					$installed = $db->loadResult();
					$error	= $db->getErrorMsg();

					if ($error) {
						$installer->parent->abort(JText::_('J_INSTALL_MODULE').' '.JText::_('J_INSTALL_INSTALL').': '.$error);
						return false;
					}

					if (!$installed) {
						$row = JTable::getInstance('module');
						$row->title		= $mtitle;
						$row->ordering	= $row->getNextOrder("position='".$mposition."'");
						$row->position	= $mposition;
						$row->showtitle	= (boolean) $mShowTitle;
						$row->iscore	= 0;
						$row->access	= ($mclient->id) == 1 ? 2 : 0;
						$row->client_id	= $mclient->id;
						$row->module	= $mname;
						$row->published	= (boolean) $mPublished;
						$row->params	= '';

						if (!$row->store()) {
							// Install failed, roll back changes
							$installer->parent->abort(JText::_('J_INSTALL_MODULE').' '.JText::_('J_INSTALL_INSTALL').': '.$row->getError());
							return false;
						}
					}
				}

				$result[] = array('name'=>$mname,'client'=>$mclient->name);
			}
		}

		return $result;
	}

	/**
	 * Install packaged modules.
	 *
	 * @param	object	$installer	The parent installer object.
	 *
	 * @return	array	An array of the installed modules.
	 * @since	1.0
	 */
	public static function installPlugins(&$installer)
	{
		$result		= array();

		$plugins = &$installer->manifest->getElementByPath('plugins');
		if (is_a($plugins, 'JSimpleXMLElement') && count($plugins->children())) {

			foreach ($plugins->children() as $plugin)
			{
				$pname		= $plugin->attributes('plugin');
				$pgroup		= $plugin->attributes('group');

				// Set the installation path
				if (!empty($pname) && !empty($pgroup)) {
					$installer->parent->setPath('extension_root', JPATH_ROOT.'/plugins/'.$pgroup);
				} else {
					$installer->parent->abort(JText::_('J_INSTALL_PLUGIN').' '.JText::_('J_INSTALL_INSTALL').': '.JText::_('J_INSTALL_PLUGIN_FILE_MISSING'));
					return false;
				}

				/**
				 * ---------------------------------------------------------------------------------------------
				 * Filesystem Processing Section
				 * ---------------------------------------------------------------------------------------------
				 */

				// If the plugin directory does not exist, lets create it
				$created = false;
				if (!file_exists($installer->parent->getPath('extension_root'))) {
					if (!$created = JFolder::create($installer->parent->getPath('extension_root'))) {
						$installer->parent->abort(JText::_('J_INSTALL_PLUGIN').' '.JText::_('J_INSTALL_INSTALL').': '.JText::sprintf('J_INSTALL_PLUGIN_PATH_CREATE_FAILURE', $installer->parent->getPath('extension_root')));
						return false;
					}
				}

				// If we created the plugin directory and will want to remove it if we
				// have to roll back the installation, lets add it to the installation
				// step stack
				if ($created) {
					$installer->parent->pushStep(array ('type' => 'folder', 'path' => $installer->parent->getPath('extension_root')));
				}

				// Copy all necessary files
				$element = &$plugin->getElementByPath('files');
				if ($installer->parent->parseFiles($element, -1) === false) {
					// Install failed, roll back changes
					$installer->parent->abort();
					return false;
				}

				// Copy all necessary files
				$element = &$plugin->getElementByPath('languages');
				if ($installer->parent->parseLanguages($element, 1) === false) {
					// Install failed, roll back changes
					$installer->parent->abort();
					return false;
				}

				// Copy media files
				$element = &$plugin->getElementByPath('media');
				if ($installer->parent->parseMedia($element, 1) === false) {
					// Install failed, roll back changes
					$installer->parent->abort();
					return false;
				}

				/**
				 * ---------------------------------------------------------------------------------------------
				 * Database Processing Section
				 * ---------------------------------------------------------------------------------------------
				 */
				$db = &JFactory::getDBO();

				// Check to see if a plugin by the same name is already installed
				$query = 'SELECT `id`' .
						' FROM `#__plugins`' .
						' WHERE folder = '.$db->Quote($pgroup) .
						' AND element = '.$db->Quote($pname);
				$db->setQuery($query);
				if (!$db->Query()) {
					// Install failed, roll back changes
					$installer->parent->abort(JText::_('J_INSTALL_PLUGIN').' '.JText::_('J_INSTALL_INSTALL').': '.$db->stderr(true));
					return false;
				}
				$id = $db->loadResult();

				// Was there a plugin already installed with the same name?
				if ($id) {

					if (!$installer->parent->getOverwrite()) {
						// Install failed, roll back changes
						$installer->parent->abort(JText::_('J_INSTALL_PLUGIN').' '.JText::_('J_INSTALL_INSTALL').': '.JText::sprintf('J_INSTALL_PLUGIN_ALREADY_EXISTS', $pname));
						return false;
					}

				} else {
					$row =& JTable::getInstance('plugin');
					$row->name = JText::_(ucfirst($pgroup)).' - '.JText::_(ucfirst($pname));
					$row->ordering = 0;
					$row->folder = $pgroup;
					$row->iscore = 0;
					$row->access = 0;
					$row->client_id = 0;
					$row->element = $pname;
					$row->published = 1;
					$row->params = '';

					if (!$row->store()) {
						// Install failed, roll back changes
						$installer->parent->abort(JText::_('J_INSTALL_PLUGIN').' '.JText::_('J_INSTALL_INSTALL').': '.$db->stderr(true));
						return false;
					}
				}

				$result[] = array('name'=>$pname,'group'=>$pgroup);
			}
		}

		return $result;
	}

	/**
	 * Check if a component exists.
	 *
	 * @param	string	$option	The name of the component folder.
	 *
	 * @return	void
	 * @since	1.0
	 */
	public static function componentExists($option)
	{
		$db = JFactory::getDbo();
		$db->setQuery(
			'SELECT id' .
			' FROM #__components' .
			' WHERE `option` = '.$db->quote($option) .
			'  AND parent = 0'
		);
		$result = $db->loadResult();
		if ($error = $db->getErrorMsg()) {
			JError::raiseError(500, $error);
		}

		return (boolean) $result;
	}

	/**
	 * Uninstall packaged modules.
	 *
	 * @param	object	$installer	The parent installer object.
	 *
	 * @return	array	An array of the installed modules.
	 * @since	1.0
	 */
	public static function uninstallModules($installer)
	{
		$modules = &$installer->manifest->getElementByPath('modules');
		if (is_a($modules, 'JSimpleXMLElement') && count($modules->children())) {

			foreach ($modules->children() as $module)
			{
				$mname		= $module->attributes('module');
				$mclient	= JApplicationHelper::getClientInfo($module->attributes('client'), true);
				$mposition	= $module->attributes('position');

				// Set the installation path
				if (!empty ($mname)) {
					$installer->parent->setPath('extension_root', $mclient->path.'/modules/'.$mname);
				}
				else {
					$installer->parent->abort(JText::_('J_INSTALL_MODULE').' '.JText::_('J_INSTALL_UNINSTALL').': '.JText::_('J_INSTALL_MODULE_FILE_MISSING'));
					return false;
				}

				/**
				 * ---------------------------------------------------------------------------------------------
				 * Database Processing Section
				 * ---------------------------------------------------------------------------------------------
				 */
				$db = &JFactory::getDBO();

				// Lets delete all the module copies for the type we are uninstalling
				$query = 'SELECT `id`' .
						' FROM `#__modules`' .
						' WHERE module = '.$db->Quote($mname) .
						' AND client_id = '.(int)$mclient->id;
				$db->setQuery($query);
				$modules = $db->loadResultArray();

				// Do we have any module copies?
				if (count($modules)) {
					JArrayHelper::toInteger($modules);
					$modID = implode(',', $modules);
					$query = 'DELETE' .
							' FROM #__modules_menu' .
							' WHERE moduleid IN ('.$modID.')';
					$db->setQuery($query);
					if (!$db->query()) {
						JError::raiseWarning(100, JText::_('J_INSTALL_MODULE').' '.JText::_('J_INSTALL_UNINSTALL').': '.$db->stderr(true));
						$retval = false;
					}
				}

				// Delete the modules in the #__modules table
				$query = 'DELETE FROM #__modules WHERE module = '.$db->Quote($mname);
				$db->setQuery($query);
				if (!$db->query()) {
					JError::raiseWarning(100, JText::_('J_INSTALL_MODULE').' '.JText::_('J_INSTALL_UNINSTALL').': '.$db->stderr(true));
					$retval = false;
				}

				/**
				 * ---------------------------------------------------------------------------------------------
				 * Filesystem Processing Section
				 * ---------------------------------------------------------------------------------------------
				 */

				// Remove all necessary files
				$element = &$module->getElementByPath('files');
				if (is_a($element, 'JSimpleXMLElement') && count($element->children())) {
					$installer->parent->removeFiles($element, -1);
				}

				// Remove all necessary files
				$element = &$module->getElementByPath('media');
				if (is_a($element, 'JSimpleXMLElement') && count($element->children())) {
					$installer->parent->removeFiles($element, -1);
				}

				$element = &$module->getElementByPath('languages');
				if (is_a($element, 'JSimpleXMLElement') && count($element->children())) {
					$installer->parent->removeFiles($element, $mclient->id);
				}

				// Remove the installation folder
				if (!JFolder::delete($installer->parent->getPath('extension_root'))) {
				}

				$status->modules[] = array('name'=>$mname,'client'=>$mclient->name);
			}
		}
	}

	/**
	 * Uninstall packaged plugins.
	 *
	 * @param	object	$installer	The parent installer object.
	 *
	 * @return	array	An array of the installed modules.
	 * @since	1.0
	 */
	public static function uninstallPlugins(&$installer)
	{
		$plugins = &$installer->manifest->getElementByPath('plugins');
		if (is_a($plugins, 'JSimpleXMLElement') && count($plugins->children())) {

			foreach ($plugins->children() as $plugin)
			{
				$pname		= $plugin->attributes('plugin');
				$pgroup		= $plugin->attributes('group');

				// Set the installation path
				if (!empty($pname) && !empty($pgroup)) {
					$installer->parent->setPath('extension_root', JPATH_ROOT.'/plugins/'.$pgroup);
				} else {
					$installer->parent->abort(JText::_('J_INSTALL_PLUGIN').' '.JText::_('J_INSTALL_UNINSTALL').': '.JText::_('J_INSTALL_PLUGIN_FILE_MISSING'));
					return false;
				}

				/**
				 * ---------------------------------------------------------------------------------------------
				 * Database Processing Section
				 * ---------------------------------------------------------------------------------------------
				 */
				$db = &JFactory::getDBO();

				// Delete the plugins in the #__plugins table
				$query = 'DELETE FROM #__plugins WHERE element = '.$db->Quote($pname).' AND folder = '.$db->Quote($pgroup);
				$db->setQuery($query);
				if (!$db->query()) {
					JError::raiseWarning(100, JText::_('J_INSTALL_PLUGIN').' '.JText::_('J_INSTALL_UNINSTALL').': '.$db->stderr(true));
					$retval = false;
				}

				/**
				 * ---------------------------------------------------------------------------------------------
				 * Filesystem Processing Section
				 * ---------------------------------------------------------------------------------------------
				 */

				// Remove all necessary files
				$element = &$plugin->getElementByPath('files');
				if (is_a($element, 'JSimpleXMLElement') && count($element->children())) {
					$installer->parent->removeFiles($element, -1);
				}

				$element = &$plugin->getElementByPath('languages');
				if (is_a($element, 'JSimpleXMLElement') && count($element->children())) {
					$installer->parent->removeFiles($element, 1);
				}

				// If the folder is empty, let's delete it
				$files = JFolder::files($installer->parent->getPath('extension_root'));
				if (!count($files)) {
					JFolder::delete($installer->parent->getPath('extension_root'));
				}

				$status->plugins[] = array('name'=>$pname,'group'=>$pgroup);
			}
		}
	}

	/**
	 * Upgrade the database with an XML schema file.
	 *
	 * @param	string	$xml	The XML string.
	 *
	 * @return	array	Returns the database upgrade log.
	 * @since	1.0
	 */
	public static function upgrade($xml)
	{
		// Include dependancies.
		require_once dirname(dirname(__FILE__)).'/libraries/joomla/database/database/mysqlxml.php';

		JDatabaseMySQLXML::import($xml);

		return JDatabaseMySQLXML::getLog();
	}
}