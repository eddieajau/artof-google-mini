<?php
/**
 * @package     NewLifeInIT
 * @subpackage  pl_artofgm_search
 * @copyright   Copyright 2011 New Life in IT Pty Ltd. All rights reserved.
 * @license     GNU General Public License version 2 or later.
 */

// No direct access
defined('_JEXEC') or die;

// Include dependancies.
if (!class_exists('modArtofGMSearchHelper'))
{
	// Load the module helper class.
	require dirname(__FILE__) . '/helper.php';

	// Load the local lanuage files.
	$lang = JFactory::getLanguage();
	$lang->load('mod_artofgm_search', dirname(__FILE__));
}

require_once JPATH_SITE . '/components/com_artofgm/helpers/route.php';

// Load the attributes in the JDOC tag into the parameters.
$temp = new JRegistry;
$temp->loadArray($attribs);
$params->merge($temp);

// Auto hide this module if we are in the Google Mini component.
if ($params->get('auto-hide') && JRequest::getCmd('option') == 'com_artofgm')
{
	return null;
}

require JModuleHelper::getLayoutPath($module->module, $params->get('layout', 'default'));
