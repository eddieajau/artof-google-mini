<?php
/**
 * @package		NewLifeInIT
 * @subpackage	com_artofgm
 * @copyright	Copyright 2011 New Life in IT Pty Ltd. All rights reserved.
 * @license		GNU General Public License version 2 or later.
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

/**
 * @package		NewLifeInIT
 * @subpackage	com_artofgm
 */
class ArtofGMViewArtofGM extends JView
{
	protected $config;
	protected $hasQuery;
	protected $items;
	protected $pagination;
	protected $state;

	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{
		try
		{
			$this->config	= JComponentHelper::getParams('com_artofgm');
			$this->state	= $this->get('State');
			$this->hasQuery	= (
				$this->state->get('list.q') ||
				$this->state->get('list.as_q') ||
				$this->state->get('list.as_epq') ||
				$this->state->get('list.as_oq')
			);

			if ($this->hasQuery) {
				$this->items	= $this->get('Items');
			}
			$this->filter		= JFilterInput::getInstance(
				array('b')
			);
			$this->pagination	= $this->get('Pagination');

			// Check for errors.
			if (count($errors = $this->get('Errors'))) {
				JError::raiseError(500, implode("\n", $errors));
				return false;
			}
		}
		catch (Exception $e)
		{
			echo $e->getMessage();die;
			JError::raiseWarning(500, $e->getMessage());
		}

		$this->addToolbar();
		parent::display($tpl);
	}

	/**
	 * Display the toolbar
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
	 * @param	string	$string
	 *
	 * @return	string
	 * @since	1.0.1
	 */
	protected function filter($string)
	{
		return $this->filter->clean($string);
	}

	/**
	 * Truncates text blocks over the specified character limit. This
	 * method is UTF-8 safe.
	 *
	 * @param	string	$text	The text to truncate.
	 * @param	int		$length	The maximum length of the text.
	 * @param	string	$append	An optional string to append (eg, '...') to the truncated string.
	 *
	 * @return	string	The truncated text.
	 * @since	7-Oct-2010
	 */
	protected function truncate($text, $length = 0, $append = '')
	{
		// Truncate the item text if it is too long.
		if ($length > 0 && JString::strlen($text) > $length) {
			$text	= JString::substr($text, 0, $length);
			$text	= $text.$append;
		}

		return $text;
	}
}