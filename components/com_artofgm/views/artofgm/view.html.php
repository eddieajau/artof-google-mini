<?php
/**
 * @package     NewLifeInIT
 * @subpackage  com_artofgm
 * @copyright   Copyright 2011 New Life in IT Pty Ltd. All rights reserved.
 * @license     GNU General Public License version 2 or later.
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

/**
 * ArtofGM mater view.
 *
 * @package     NewLifeInIT
 * @subpackage  com_artofgm
 * @since       1.0
 */
class ArtofGMViewArtofGM extends JView
{
	/**
	 * @var    JObject
	 * @since  1.0
	 */
	protected $state;

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
	protected $params;

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
			$this->state = $this->get('State');
			$this->hasQuery = ($this->state->get('list.q')
				|| $this->state->get('list.as_q')
				|| $this->state->get('list.as_epq')
				|| $this->state->get('list.as_oq'));

			if ($this->hasQuery)
			{
				$this->items = $this->get('Items');
			}
			$this->pagination = $this->get('Pagination');
			$this->params = $this->get('Params');

			// Check for errors.
			if (count($errors = $this->get('Errors')))
			{
				throw new Exception(implode("\n", $errors));
			}

			parent::display($tpl);
		}
		catch (Exception $e)
		{
			JError::raiseWarning(500, $e->getMessage());
		}
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
	 * @since	7-Oct-2010
	 */
	public function truncate($text, $length = 0, $append = '')
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
