<?php
/**
 * @package		NewLifeInIT
 * @subpackage	com_artofgm
 * @copyright	Copyright 2011 New Life in IT Pty Ltd. All rights reserved.
 * @license		GNU General Public License version 2 or later.
 */

// No direct access
defined('_JEXEC') or die;

// Load local language file.
$lang = JFactory::getLanguage();
$lang->load('com_artofgm', JPATH_COMPONENT);

// Include dependancies.
require_once JPATH_COMPONENT.'/version.php';
require_once JPATH_COMPONENT.'/libraries/loader.php';

juimport('joomla.application.component.controller');

$controller = JController::getInstance('ArtofGM');
$controller->execute(JRequest::getVar('task'));
$controller->redirect();
