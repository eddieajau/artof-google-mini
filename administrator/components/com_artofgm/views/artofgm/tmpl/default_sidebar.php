<?php
/**
 * @package		NewLifeInIT
 * @subpackage	com_artofgm
 * @copyright	Copyright 2011 New Life in IT Pty Ltd. All rights reserved.
 * @license		GNU General Public License version 2 or later.
 */

// No direct access
defined('_JEXEC') or die;
?>

<table class="admintable">
	<tbody>
		<tr>
			<td class="key2">
				<?php echo JText::_('COM_ARTOFGM_PARAM_SERVER_LABEL'); ?>
			</td>
			<td>
				<?php echo $this->escape($this->config->get('server')); ?>
			</td>
		</tr>
		<tr>
			<td class="key2">
				<?php echo JText::_('COM_ARTOFGM_PARAM_DL_METHOD_LABEL'); ?>
			</td>
			<td>
				<?php echo $this->escape($this->config->get('dl_method')); ?>
			</td>
		</tr>
		<tr>
			<td class="key2">
				<?php echo JText::_('COM_ARTOFGM_PARAM_SITE_LABEL'); ?>
			</td>
			<td>
				<?php echo $this->escape($this->config->get('site')); ?>
			</td>
		</tr>
		<tr>
			<td class="key2">
				<?php echo JText::_('COM_ARTOFGM_PARAM_CLIENT_LABEL'); ?>
			</td>
			<td>
				<?php echo $this->escape($this->config->get('client')); ?>
			</td>
		</tr>
		<tr>
			<td class="key2">
				<?php echo JText::_('COM_ARTOFGM_PARAM_DL_PROXY_LABEL'); ?>
			</td>
			<td>
				<?php echo $this->config->get('dl_proxy') ? JText::_('Yes') : JText::_('No'); ?>
			</td>
		</tr>
		<tr>
			<td class="key2">
				<?php echo JText::_('COM_ARTOFGM_PARAM_DL_PROXY_HOST_LABEL'); ?>
			</td>
			<td>
				<?php echo $this->escape($this->config->get('dl_proxy_host')); ?>
			</td>
		</tr>
		<tr>
			<td class="key2">
				<?php echo JText::_('COM_ARTOFGM_PARAM_DL_PROXY_PORT_LABEL'); ?>
			</td>
			<td>
				<?php echo $this->escape($this->config->get('dl_proxy_port')); ?>
			</td>
		</tr>
		<tr>
			<td class="key2">
				<?php echo JText::_('COM_ARTOFGM_PARAM_DL_PROXY_USER_LABEL'); ?>
			</td>
			<td>
				<?php echo $this->escape($this->config->get('dl_proxy_user')); ?>
			</td>
		</tr>
		<tr>
			<td class="key2">
				<?php echo JText::_('COM_ARTOFGM_PARAM_DL_PROXY_PASS_LABEL'); ?>
			</td>
			<td>
				<?php echo $this->escape($this->config->get('dl_proxy_pass')); ?>
			</td>
		</tr>
	</tbody>
</table>
