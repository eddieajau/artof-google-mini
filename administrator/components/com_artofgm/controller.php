<?php
/**
 * @package     NewLifeInIT
 * @subpackage  com_artofgm
 * @copyright   Copyright 2011 New Life in IT Pty Ltd. All rights reserved.
 * @license     GNU General Public License version 2 or later.
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controller');

/**
 * Component Controller
 *
 * @package     NewLifeInIT
 * @subpackage  com_artofuser
 * @since       1.0
 */
class ArtofGMController extends JController
{
	/**
	 * Override the display method for the controller.
	 *
	 * @return  void
	 *
	 * @since   1.0
	 */
	public function display()
	{
		// Load the component helper.
		require_once JPATH_COMPONENT . '/helpers/artofgm.php';

		// Display the view.
		parent::display();
	}

	/**
	 * Method to get a model object, loading it if required.
	 *
	 * @param   string  $name    The model name. Optional.
	 * @param   string  $prefix  The class prefix. Optional.
	 * @param   array   $config  Configuration array for model. Optional.
	 *
	 * @return  object	The model.
	 *
	 * @since   1.5
	 */
	public function &getModel($name = '', $prefix = '', $config = array())
	{
		$model = parent::getModel($name, $prefix, $config);
		$model->setState('debug', true);

		return $model;
	}
}
