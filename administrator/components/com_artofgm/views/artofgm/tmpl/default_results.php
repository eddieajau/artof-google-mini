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
	<?php echo JText::_('COM_ARTOGM_RESULTS_HEADING'); ?>
</h1>

<table class="adminlist">
	<thead>
		<tr>
			<th>
				<?php echo JText::_('COM_ARTOFGM_N_HEADING'); ?>
			</th>
			<th>
				<?php echo JText::_('COM_ARTOFGM_MIME_HEADING'); ?>
			</th>
			<th>
				<?php echo JText::_('COM_ARTOFGM_INDENT_HEADING'); ?>
			</th>
			<th>
				<?php echo JText::_('COM_ARTOFGM_TITLE_HEADING'); ?>
				<br /><?php echo JText::_('COM_ARTOFGM_SNIPPET_HEADING'); ?>
				<br /><?php echo JText::_('COM_ARTOFGM_URL_HEADING'); ?>
			</th>
		</tr>
	</thead>

	<?php foreach ($this->items as $item) : ?>
	<tbody>
		<?php if ($item->gm) : ?>
		<tr>
			<td>
				-
			</td>
			<td>
				-
			</td>
			<td>
				-
			</td>
			<td>
				<p><?php echo $this->escape($item->gd); ?></p>
				<p>-</p>
				<p><?php echo $this->escape($item->gl); ?></p>
			</td>
		</tr>
		<?php else : ?>
		<tr>
			<td>
				<?php echo (int) $item->n; ?>
			</td>
			<td>
				<?php echo $this->escape($item->mime); ?>
			</td>
			<td>
				<?php echo (int) $item->indent; ?>
			</td>
			<td>
				<p><?php echo $this->escape($item->title); ?></p>
				<p><?php echo $this->filter($item->snippet); ?></p>
				<p><?php echo $this->escape($item->url); ?></p>
			</td>
		</tr>
		<?php endif; ?>
	</tbody>
	<?php endforeach; ?>

</table>
