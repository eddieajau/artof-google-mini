<?php
/**
 * @package     NewLifeInIT
 * @subpackage  com_artofgm
 *
 * @copyright   Copyright 2011 New Life in IT Pty Ltd. All rights reserved.
 * @license     GNU General Public License version 2 or later.
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

/**
 * Master view.
 *
 * @package     NewLifeInIT
 * @subpackage  com_artofgm
 * @since       1.0
 */
class ArtofGMViewArtofGM extends JView
{
	/**
	 * @var    JRegistry
	 * @since  1.0
	 */
	protected $config;

	/**
	 * @var    boolean
	 * @since  1.0
	 */
	protected $hasQuery;

	/**
	 * @var    array
	 * @since  1.0
	 */
	protected $items;

	/**
	 * @var    JPagination
	 * @since  1.0
	 */
	protected $pagination;

	/**
	 * @var    JObject
	 * @since  1.0
	 */
	protected $state;

	/**
	 * Overrides the view display to add custom data.
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  mixed  A string if successful, otherwise a JError object.
	 *
	 * @since   1.0
	 */
	public function display($tpl = null)
	{
		try
		{
			$this->config = JComponentHelper::getParams('com_artofgm');
			$this->state = $this->get('State');
			$this->hasQuery = ($this->state->get('list.q')
				|| $this->state->get('list.as_q')
				|| $this->state->get('list.as_epq')
				|| $this->state->get('list.as_oq'));

			if ($this->hasQuery)
			{
				$this->items = $this->get('Items');
			}

			$this->filter = JFilterInput::getInstance(array('b'));
			$this->pagination = $this->get('Pagination');

			// Check for errors.
			if (count($errors = $this->get('Errors')))
			{
				JError::raiseError(500, implode("\n", $errors));
				return false;
			}
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
			die;
			JError::raiseWarning(500, $e->getMessage());
		}

		$this->addToolbar();
		parent::display($tpl);
	}

	/**
	 * Add the toolbar
	 *
	 * @return  void
	 *
	 * @since   1.0
	 */
	protected function addToolbar()
	{
		$bar = JToolBar::getInstance('toolbar');

		JToolBarHelper::title(JText::_('COM_ARTOFGM_TITLE'), 'logo');
		JToolBarHelper::preferences('com_artofgm', 360, 800, 'COM_ARTOFGM_TOOLBAR_OPTIONS');

		// We can't use the toolbar helper here because there is no generic popup button.
		JToolBar::getInstance('toolbar')
			->appendButton('Popup', 'help', 'COM_ARTOFGM_TOOLBAR_ABOUT', 'index.php?option=com_artofgm&view=about&tmpl=component');
	}

	/**
	 * Clean the output.
	 *
	 * @param   string  $string  The string to filter.
	 *
	 * @return  string
	 *
	 * @since   1.0.1
	 */
	protected function filter($string)
	{
		return $this->filter->clean($string);
	}

	/**
	 * Truncates text blocks over the specified character limit. This
	 * method is UTF-8 safe.
	 *
	 * @param   string  $text    The text to truncate.
	 * @param   int     $length  The maximum length of the text.
	 * @param   string  $append  An optional string to append (eg, '...') to the truncated string.
	 *
	 * @return  string	The truncated text.
	 *
	 * @since	1.0
	 */
	protected function truncate($text, $length = 0, $append = '')
	{
		// Truncate the item text if it is too long.
		if ($length > 0 && JString::strlen($text) > $length)
		{
			$text = JString::substr($text, 0, $length);
			$text = $text . $append;
		}

		return $text;
	}
}
