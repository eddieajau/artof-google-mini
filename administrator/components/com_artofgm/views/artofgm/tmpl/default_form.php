<?php
/**
 * @package     NewLifeInIT
 * @subpackage  com_artofgm
 * @copyright   Copyright 2011 New Life in IT Pty Ltd. All rights reserved.
 * @license     GNU General Public License version 2 or later.
 */

// No direct access
defined('_JEXEC') or die;
?>

<form id="google-search" method="get" action="<?php echo JRoute::_('index.php?option=artofgm'); ?>" name="adminForm">
	<input type="hidden" name="option" value="com_artofgm" />
	<input type="hidden" name="limitstart" value="<?php echo (int) $this->pagination->limitstart; ?>" />

	<table class="admintable">
		<tbody>
			<tr>
				<td colspan="2">
					<?php echo JText::_('COM_ARTOFGM_BASIC_SEARCH'); ?>
				</td>
			</tr>
			<tr>
				<td class="key2">
					<?php echo JText::_('COM_ARTOFGM_INPUT_Q_LABEL'); ?>
				</td>
				<td>
					<input type="text" name="q" size="100" maxlength="256" value="<?php echo $this->escape($this->state->get('list.q'));?>" />
				</td>
			</tr>

			<tr>
				<td colspan="2">
					<?php echo JText::_('COM_ARTOFGM_ADVANCED_SEARCH'); ?>
				</td>
			</tr>
			<tr>
				<td class="key2">
					<?php echo JText::_('COM_ARTOFGM_INPUT_AS_Q_LABEL'); ?>
				</td>
				<td>
					<input type="text" name="as_q" size="60" maxlength="256" value="<?php echo $this->escape($this->state->get('list.as_q'));?>" />
				</td>
			</tr>
			<tr>
				<td class="key2">
					<?php echo JText::_('COM_ARTOFGM_INPUT_AS_EPQ_LABEL'); ?>
				</td>
				<td>
					<input type="text" name="as_epq" size="60" maxlength="256" value="<?php echo $this->escape($this->state->get('list.as_epq'));?>" />
				</td>
			</tr>
			<tr>
				<td class="key2">
					<?php echo JText::_('COM_ARTOFGM_INPUT_AS_OQ_LABEL'); ?>
				</td>
				<td>
					<input type="text" name="as_oq" size="60" maxlength="256" value="<?php echo $this->escape($this->state->get('list.as_oq'));?>" />
				</td>
			</tr>
			<tr>
				<td class="key2">
					<?php echo JText::_('COM_ARTOFGM_INPUT_AS_EQ_LABEL'); ?>
				</td>
				<td>
					<input type="text" name="as_eq" size="60" maxlength="256" value="<?php echo $this->escape($this->state->get('list.as_eq'));?>" />
				</td>
			</tr>
			<tr>
				<td class="key2">
					<?php echo JText::_('COM_ARTOFGM_INPUT_LR_LABEL'); ?>
				</td>
				<td>
					<select name="as_lr">
						<option value=""><?php echo JText::_('COM_ARTOFGM_OPTION_LANGUAGE_ANY'); ?>
						<?php echo JHtml::_('select.options', ArtofGmHelper::getLanguageOptions(), 'value', 'text', $this->state->get('list.lr')); ?>
					</select>
				</td>
			</tr>
			<tr>
				<td class="key2">
					<?php echo JText::_('COM_ARTOFGM_INPUT_AS_FT_LABEL'); ?>
				</td>
				<td>
					<select name="as_ft">
						<?php echo JHtml::_('select.options', ArtofGmHelper::getInclExclOptions(), 'value', 'text', $this->state->get('list.as_ft')); ?>
					</select>
					<?php echo JText::_('COM_ARTOFGM_INPUT_AS_FILETYPE_LABEL'); ?>
					<select name="as_filetype">
						<option value=""><?php echo JText::_('COM_ARTOFGM_OPTION_FORMAT_ANY'); ?>
						<?php echo JHtml::_('select.options', ArtofGmHelper::getFiletypeOptions(), 'value', 'text', $this->state->get('list.as_filetype')); ?>
					</select>
				</td>
			</tr>
			<tr>
				<td class="key2">
					<?php echo JText::_('COM_ARTOFGM_INPUT_AS_OCCT_LABEL'); ?>
				</td>
				<td>
					<select name="as_occt">
						<option value=""><?php echo JText::_('COM_ARTOFGM_OPTION_OCCURENCE_ANY'); ?>
						<?php echo JHtml::_('select.options', ArtofGmHelper::getOccurenceOptions(), 'value', 'text', $this->state->get('list.as_occt')); ?>
					</select>
				</td>
			</tr>
			<tr>
				<td class="key2">
					<?php echo JText::_('COM_ARTOFGM_INPUT_AS_DT_LABEL'); ?>
				</td>
				<td>
					<select name="as_dt">
						<?php echo JHtml::_('select.options', ArtofGmHelper::getInclExclOptions(), 'value', 'text', $this->state->get('list.as_dt')); ?>
					</select>
					<?php echo JText::_('COM_ARTOFGM_INPUT_AS_SITESEARCH_LABEL'); ?>
					<input type="text" name="as_sitesearch" size="32" maxlength="256" value="<?php echo $this->escape($this->state->get('list.as_sitesearch'));?>" />
				</td>
			</tr>

			<tr>
				<td class="key2">
					<?php echo JText::_('COM_ARTOFGM_INPUT_SORT_LABEL'); ?>
				</td>
				<td>
					<select name="sort">
						<option value=""><?php echo JText::_('COM_ARTOFGM_OPTION_SORT_RELEVANCE'); ?>
						<?php echo JHtml::_('select.options', ArtofGmHelper::getSortOptions(), 'value', 'text', $this->state->get('list.sort')); ?>
					</select>
				</td>
			</tr>

			<tr>
				<td class="key2">
					<?php echo JText::_('COM_ARTOFGM_INPUT_FILTER_LABEL'); ?>
				</td>
				<td>
					<select name="filter">
						<?php echo JHtml::_('select.options', ArtofGmHelper::getFilterOptions(), 'value', 'text', $this->state->get('list.filter')); ?>
					</select>
				</td>
			</tr>

			<tr>
				<td class="key2">
					<?php echo JText::_('COM_ARTOFGM_INPUT_AS_LQ_LABEL'); ?>
				</td>
				<td>
					<input type="text" name="as_lq" size="100" maxlength="256" value="<?php echo $this->escape($this->state->get('list.as_lq'));?>" />
				</td>
			</tr>

			<tr>
				<td class="key2">
					<?php echo JText::_('COM_ARTOFGM_LIMIT_LABEL'); ?>
				</td>
				<td>
					<?php echo $this->pagination->getLimitBox(); ?>
				</td>
			</tr>
			<tr>
				<td class="key2">
					<?php echo JText::_('COM_ARTOFGM_PAGINATION_LABEL'); ?>
				</td>
				<td>
					<?php echo $this->pagination->getPagesLinks(); ?>
				</td>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<button type="submit"><?php echo JText::_('COM_ARTOFGM_TEST_SEARCH_BUTTON'); ?></button>
				</td>
			</tr>
		</tbody>
	</table>

</form>
