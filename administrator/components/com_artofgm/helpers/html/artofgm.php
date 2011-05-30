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
 * Component HTML Helper
 *
 * @package		NewLifeInIT
 * @subpackage	com_artofgm
 * @since		1.5
 */
class JHtmlArtofGM
{
	/**
	 * Displays the page footer
	 *
	 * @return	void
	 * @since	1.0
	 */
	function footer()
	{
		JHtml::_('behavior.modal', 'a.modal');
		echo '<div id="taojfooter">';
		echo  '<a href="'.JRoute::_('index.php?option=com_artofgm&view=about&tmpl=component').'" class="modal" rel="{handler: \'iframe\'}">';
		echo 'Artof Google Mini '.ArtofGMVersion::getVersion(false, true).'</a>';
		echo ' &copy; 2005 - 2010 <a href="http://www.newlifeinit.com" target="_blank">New Life in IT Pty Ltd</a>. All rights reserved.';
		echo '</div>';
	}
}
