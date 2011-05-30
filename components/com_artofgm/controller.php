<?php
/**
 * @package		NewLifeInIT
 * @subpackage	com_artofgm
 * @copyright	Copyright 2011 New Life in IT Pty Ltd. All rights reserved.
 * @license		GNU General Public License version 2 or later.
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controller');

/**
 * Component Controller
 *
 * @package		NewLifeInIT
 * @subpackage	com_artofuser
 */
class ArtofGMController extends JController
{
	/**
	 * Override the display method for the controller.
	 *
	 * @return	void
	 * @since	1.0
	 */
	function display()
	{
		// Load the component helper.
		require_once JPATH_COMPONENT_ADMINISTRATOR.'/helpers/artofgm.php';

		// Display the view.
		parent::display();
	}
}