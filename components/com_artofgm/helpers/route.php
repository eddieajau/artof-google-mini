<?php
/**
 * @package     NewLifeInIT
 * @subpackage  com_artofgm
 * @copyright   Copyright 2011 New Life in IT Pty Ltd. All rights reserved.
 * @license     GNU General Public License version 2 or later.
 */

// No direct access
defined('_JEXEC') or die;

/**
 * Artof Google Mini route helper.
 *
 * @package     NewLifeInIT
 * @subpackage  com_artofgm
 * @since       1.0
 */
class ArtofGMHelperRoute
{
	/**
	 * @var    array
	 *
	 * @since  1.0
	 */
	protected static $lookup;

	/**
	 * Get the component route.
	 *
	 * @return  string
	 *
	 * @since   1.0
	 */
	public static function getRoute()
	{
		//Create the link
		$link = 'index.php?option=com_artofgm&view=artofgm';

		$itemId = self::_findItem();
		if ($itemId)
		{
			$link .= '&Itemid=' . $itemId;
		}

		return $link;
	}

	/**
	 * Find the itemid given search needles.
	 *
	 * @param   array  $needles  An array of the search needles by view.
	 *
	 * @return  integer
	 *
	 * @since   1.0
	 */
	protected static function _findItem($needles = array('artofgm' => true))
	{
		$app		= JFactory::getApplication();
		$menus		= $app->getMenu('site');

		// Prepare the reverse lookup array.
		if (self::$lookup === null)
		{
			self::$lookup = array();

			// Get a list of the menu items for this component.
			$component = JComponentHelper::getComponent('com_artofgm');
			$items = $menus->getItems('component_id', $component->id);
			if (!empty($items))
			{
				foreach ($items as $item)
				{
					if (isset($item->query) && isset($item->query['view']))
					{
						// Build the view lookup.
						$view = $item->query['view'];
						if (!isset(self::$lookup[$view]))
						{
							// This extension only supports view. First in best dressed.
							self::$lookup[$view] = $item->id;
						}
					}
				}
			}
			// Finished building reverse-lookup array.
		}

		if ($needles)
		{
			// Search the needles against the lookup array and try to find match.
			foreach ($needles as $view => $itemId)
			{
				// This component only has one view so it's quite trivial.
				if (isset(self::$lookup[$view]))
				{
					return self::$lookup[$view];
				}
			}

			// No needle matches found.
		}
		else
		{
			// No needles so just get the active page.
			$active = $menus->getActive();
			if ($active)
			{
				return $active->id;
			}
		}

		return null;
	}
}
