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
<h1>
	<?php echo JText::_('COM_ARTOGM_METRICS_HEADING'); ?>
</h1>

<table class="admintable">
	<tbody>
		<tr>
			<td class="key2">
				<?php echo JText::_('COM_ARTOFGM_URL_LABEL'); ?>
			</td>
			<td>
				<?php echo $this->escape($this->state->get('server.url')); ?>
			</td>
		</tr>
		<tr>
			<td class="key2">
				<?php echo JText::_('COM_ARTOFGM_MAGNITUDE_LABEL'); ?>
			</td>
			<td>
				<?php echo $this->escape($this->state->get('list.magnitude')); ?>
			</td>
		</tr>
		<tr>
			<td class="key2">
				<?php echo JText::_('COM_ARTOFGM_START_NUM_LABEL'); ?>
			</td>
			<td>
				<?php echo $this->escape($this->state->get('list.startnum')); ?>
			</td>
		</tr>
		<tr>
			<td class="key2">
				<?php echo JText::_('COM_ARTOFGM_END_NUM_LABEL'); ?>
			</td>
			<td>
				<?php echo $this->escape($this->state->get('list.endnum')); ?>
			</td>
		</tr>
		<tr>
			<td class="key2">
				<?php echo JText::_('COM_ARTOFGM_HAS_NEXT_LABEL'); ?>
			</td>
			<td>
				<?php echo JText::_($this->state->get('list.hasnext') ? 'YES' : 'NO'); ?>
			</td>
		</tr>
		<tr>
			<td class="key2">
				<?php echo JText::_('COM_ARTOFGM_FILTERED_LABEL'); ?>
			</td>
			<td>
				<?php echo JText::_($this->state->get('list.filtered') ? 'YES' : 'NO'); ?>
			</td>
		</tr>
		<tr>
			<td class="key2">
				<?php echo JText::_('COM_ARTOFGM_SPELLING_LABEL'); ?>
			</td>
			<td>
				<?php echo $this->escape($this->state->get('list.spelling')); ?>
			</td>
		</tr>
</table>
