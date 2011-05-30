<?php
/**
 * @package		NewLifeInIT
 * @subpackage	com_artofgm
 * @copyright	Copyright 2011 New Life in IT Pty Ltd. All rights reserved.
 * @license		GNU General Public License version 2 or later.
 */

// No direct access
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');

if ($this->params->get('use_stylesheet')) {
	JHtml::stylesheet('default.css', 'components/com_artofgm/media/css/');
}

$spelling	= $this->state->get('list.spelling');
$Itemid		= JRequest::getInt('Itemid');
?>

<div class="google">
	<div class="form">
		<form id="google-search" method="get" action="<?php echo JRoute::_('index.php?option=com_artofgm'); ?>" name="">
			<input type="hidden" name="option" value="com_artofgm" />
			<input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>" />
			<?php if ($this->state->get('list.filter') !== null) : ?>
				<input type="hidden" name="filter" value="<?php echo $this->state->get('list.filter'); ?>" />
			<?php endif; ?>

			<input type="text" name="q" size="32" maxlength="256" value="<?php echo $this->escape($this->state->get('list.q'));?>" />
			<button type="submit"><?php echo JText::_('COM_ARTOFGM_SEARCH_BUTTON'); ?></button>

			<?php if ($this->params->get('show_limit', true)) : ?>
				<?php echo $this->pagination->getLimitBox(); ?>
			<?php endif; ?>

			<?php if ($this->params->get('show_advanced_search', true)) : ?>
				<a href="<?php echo JRoute::_('index.php?option=com_artofgm&layout=advanced'); ?>">
					<?php echo JText::_('COM_ARTOFGM_ADVANCED_SEARCH'); ?></a>
			<?php endif; ?>
		</form>
	</div>

	<?php if ($spelling) : ?>
	<p class="suggest g">
		<?php echo JText::sprintf('COM_ARTOFGM_DID_YOU_MEAN',
			JRoute::_('index.php?option=com_artofgm' .
					'&q='.$this->escape($spelling).
					'&limitstart=0'.
					($Itemid ? '&Itemid='.$Itemid : '')
			),
			$spelling
		); ?>
	</p>
	<?php endif; ?>

	<?php if (!empty($this->items)) : ?>
		<?php echo $this->loadTemplate('results'); ?>
	<?php endif; ?>
</div>