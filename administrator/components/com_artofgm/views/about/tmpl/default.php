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

JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
JHtml::stylesheet('default.css', 'administrator/components/com_ARTOFGM/media/css/');

// Initialise variables.
$db			= JFactory::getDbo();
$jVersion	= new JVersion;

// Pre-compute server information.
if (isset($_SERVER['SERVER_SOFTWARE'])) {
	$server = $_SERVER['SERVER_SOFTWARE'];
}
else  {
	$sf = getenv('SERVER_SOFTWARE');
	if ($sf) {
		$server = $sf;
	}
	else {
		$server = 'Not applicable.';
	}
}
?>
	<h1>
		<?php echo JText::_('COM_ARTOFGM_TITLE');?>
	</h1>

	<p>
		<?php echo JText::_('COM_ARTOFGM_DESC'); ?>
	</p>

	<p>
		<a href="http://www.theartofjoomla.com/extensions/artof-google-mini.html">
			http://www.theartofjoomla.com/extensions/artof-google-mini.html</a>
		<br />
		<a href="http://code.google.com/apis/searchappliance/documentation/68/xml_reference.html#results_xml">
			http://code.google.com/apis/searchappliance/documentation/68/xml_reference.html#results_xml</a>
	</p>

	<h2>
		<?php echo JText::_('COM_ARTOFGM_ABOUT_SUPPORT');?>
	</h2>

	<p>
		<?php echo JText::_('COM_ARTOFGM_ABOUT_SUPPORT_DESC');?><p>

	<textarea style="width:100%;font-family:monospace;" onclick="this.focus();this.select();" rows="10">
Joomla   : <?php echo $jVersion->getLongVersion(); ?>

Software : Artof Google Mini <?php echo ArtofGMVersion::getVersion(false, true); ?>

Server   : <?php echo $server; ?>

PHP      : <?php echo phpversion(); ?>

Database : <?php echo $db->getVersion(); ?> <?php echo $db->getCollation(); ?>

Browser  : <?php echo htmlspecialchars(phpversion() <= '4.2.1' ? getenv('HTTP_USER_AGENT') : $_SERVER['HTTP_USER_AGENT'], ENT_QUOTES); ?>

Platform : <?php echo php_uname(); ?> <?php echo php_sapi_name(); ?>
	</textarea>

	<h2>
		<?php echo JText::_('COM_ARTOFGM_ABOUT_CHANGELOG');?>
	</h2>

	<dl>
		<dt>Version 1.0.1 - April 2011</dt>
		<dd>
			<ul>
				<li>Allowed the site and client URL arguments to be overridden.</li>
				<li>Added support for displaying KeyMatch results.</li>
				<li>Fixed incorrect escaping of some results.</li>
				<li>Added styling to frontend list pagination to fix problems caused by RocketTheme templates.</li>
				<li>Fixed misclosed Advanced Search anchor tag.</li>
				<li>Fixed routing issues because of bad option.</li>
				<li>Removed spurious debugging code.</li>
			</ul>
		</dd>

		<dt>Version 1.0.0 - November 2010</dt>
		<dd>
			<ul>
				<li>Initial release.</li>
			</ul>
		</dd>
	</dl>
