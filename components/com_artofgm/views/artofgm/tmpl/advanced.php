<?php
/**
 * @package     NewLifeInIT
 * @subpackage  com_artofgm
 * @copyright   Copyright 2011 New Life in IT Pty Ltd. All rights reserved.
 * @license     GNU General Public License version 2 or later.
 */

// No direct access
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');

if ($this->params->get('use_stylesheet')) {
	JHtml::stylesheet('default.css', 'components/com_artofgm/media/css/');
}

// Shortcuts.
$Itemid			= JRequest::getInt('Itemid');
$showLanguages	= $this->params->get('show_language', false);
$showFiletypes	= $this->params->get('show_filetypes', false);
$showOccurences	= $this->params->get('show_occurences', false);
$showDomain		= $this->params->get('show_domain', false);
$showLinks		= $this->params->get('show_links', false);
$showSort		= $this->params->get('show_sort', false);
?>

<h3><?php echo JText::_('COM_ARTOFGM_ADVANCED_SEARCH'); ?></h3>

<div class="google">
	<div class="form">
		<form action="<?php echo JRoute::_('index.php?option=com_artofgm');?>">
			<input type="hidden" name="option" value="com_artofgm" />
			<input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>" />

			<table class="as">
				<tbody>
					<tr>
						<th rowspan="4">
							<?php echo JText::_('COM_ARTOFGM_FIND_RESULTS_HEADING'); ?>
						</th>
						<td class="key">
							<?php echo JText::_('COM_ARTOFGM_INPUT_AS_Q_LABEL'); ?>
						</td>
						<td>
							<input type="text" name="as_q" size="32" maxlength="256" value="<?php echo $this->escape($this->state->get('list.as_q'));?>" />
						</td>
					</tr>
					<tr>
						<td class="key">
							<?php echo JText::_('COM_ARTOFGM_INPUT_AS_EPQ_LABEL'); ?>
						</td>
						<td>
							<input type="text" name="as_epq" size="32" maxlength="256" value="<?php echo $this->escape($this->state->get('list.as_epq'));?>" />
						</td>
					</tr>
					<tr>
						<td class="key">
							<?php echo JText::_('COM_ARTOFGM_INPUT_AS_OQ_LABEL'); ?>
						</td>
						<td>
							<input type="text" name="as_oq" size="32" maxlength="256" value="<?php echo $this->escape($this->state->get('list.as_oq'));?>" />
						</td>
					</tr>
					<tr>
						<td class="key">
							<?php echo JText::_('COM_ARTOFGM_INPUT_AS_EQ_LABEL'); ?>
						</td>
						<td>
							<input type="text" name="as_eq" size="32" maxlength="256" value="<?php echo $this->escape($this->state->get('list.as_eq'));?>" />
						</td>
					</tr>

					<?php if ($showLanguages) : ?>
					<tr>
						<th>
							<?php echo JText::_('COM_ARTOFGM_LANGUAGE_HEADING'); ?>
						</th>
						<td class="key">
							<?php echo JText::_('COM_ARTOFGM_INPUT_LR_LABEL'); ?>
						</td>
						<td>
							<select name="as_lr">
								<option value=""><?php echo JText::_('COM_ARTOFGM_OPTION_LANGUAGE_ANY'); ?>
								<?php echo JHtml::_('select.options', ArtofGmHelper::getLanguageOptions(), 'value', 'text', $this->state->get('list.lr')); ?>
							</select>
						</td>
					</tr>
					<?php endif; ?>

					<?php if ($showFiletypes) : ?>
					<tr>
						<th>
							<?php echo JText::_('COM_ARTOFGM_FILE_FORMAT_HEADING'); ?>
						</th>
						<td class="key">
							<select name="as_ft">
								<?php echo JHtml::_('select.options', ArtofGmHelper::getInclExclOptions(), 'value', 'text', $this->state->get('list.as_ft')); ?>
							</select>
							<?php echo JText::_('COM_ARTOFGM_INPUT_AS_FT_LABEL'); ?>
						</td>
						<td>
							<select name="as_filetype">
								<option value=""><?php echo JText::_('COM_ARTOFGM_OPTION_FORMAT_ANY'); ?>
								<?php echo JHtml::_('select.options', ArtofGmHelper::getFiletypeOptions(), 'value', 'text', $this->state->get('list.as_filetype')); ?>
							</select>
						</td>
					</tr>
					<?php endif; ?>

					<?php if ($showOccurences) : ?>
					<tr>
						<th>
							<?php echo JText::_('COM_ARTOFGM_OCCURENCES_HEADING'); ?>
						</th>
						<td class="key">
							<?php echo JText::_('COM_ARTOFGM_INPUT_AS_OCCT_LABEL'); ?>
						</td>
						<td>
							<select name="as_occt">
								<option value=""><?php echo JText::_('COM_ARTOFGM_OPTION_OCCURENCE_ANY'); ?>
								<?php echo JHtml::_('select.options', ArtofGmHelper::getOccurenceOptions(), 'value', 'text', $this->state->get('list.as_occt')); ?>
							</select>
						</td>
					</tr>
					<?php endif; ?>

					<?php if ($showDomain) : ?>
					<tr>
						<th>
							<?php echo JText::_('COM_ARTOFGM_DOMAIN_HEADING'); ?>
						</th>
						<td class="key">
							<select name="as_dt">
								<?php echo JHtml::_('select.options', ArtofGmHelper::getInclExclOptions(), 'value', 'text', $this->state->get('list.as_dt')); ?>
							</select>
							<?php echo JText::_('COM_ARTOFGM_INPUT_AS_DT_LABEL'); ?>
						</td>
						<td>
							<input type="text" name="as_sitesearch" size="32" maxlength="256" value="<?php echo $this->escape($this->state->get('list.as_sitesearch'));?>" />
						</td>
					</tr>
					<?php endif; ?>

					<?php if ($showLinks) : ?>
					<tr>
						<th>
							<?php echo JText::_('COM_ARTOFGM_LINKS_HEADING'); ?>
						</th>
						<td class="key">
							<?php echo JText::_('COM_ARTOFGM_INPUT_AS_LQ_LABEL'); ?>
						</td>
						<td>
							<input type="text" name="as_lq" size="32" maxlength="256" value="<?php echo $this->escape($this->state->get('list.as_lq'));?>" />
						</td>
					</tr>
					<?php endif; ?>

					<?php if ($showSort) : ?>
					<tr>
						<th>
							<?php echo JText::_('COM_ARTOFGM_SORT_HEADING'); ?>
						</th>
						<td colspan="2">
							<select name="sort">
								<option value=""><?php echo JText::_('COM_ARTOFGM_OPTION_SORT_RELEVANCE'); ?>
								<?php echo JHtml::_('select.options', ArtofGmHelper::getSortOptions(), 'value', 'text', $this->state->get('list.sort')); ?>
							</select>
						</td>
					</tr>
					<?php endif; ?>

					<tr>
						<th>
							<?php echo JText::_('COM_ARTOFGM_LIMIT_LABEL'); ?>
						</th>
						<td colspan="2">
							<?php echo $this->pagination->getLimitBox(); ?>
						</td>
					</tr>
					<tr>
						<td colspan="2" align="center">
							<button type="submit"><?php echo JText::_('COM_ARTOFGM_SEARCH_BUTTON'); ?></button>
						</td>
					</tr>
				</tbody>
			</table>
		</form>
	</div>
</div>
