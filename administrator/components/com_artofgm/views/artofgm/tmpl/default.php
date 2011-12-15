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
JHtml::stylesheet('default.css', 'administrator/components/com_artofgm/media/css/');
?>

	<?php if (!$this->config->get('server')) : ?>
		<?php echo JText::_('COM_ARTOFGM_ERROR_CONFIGURE_SERVER'); ?>
	<?php else : ?>

		<?php if ($this->hasQuery) : ?>

			<?php echo $this->loadTemplate('form'); ?>
			<?php echo $this->loadTemplate('metrics'); ?>
			<?php echo $this->loadTemplate('results'); ?>
			<?php echo $this->loadTemplate('response'); ?>

		<?php else : ?>

		<div class="col width-70">
			<?php echo $this->loadTemplate('form'); ?>
		</div>

		<div class="col width-30">
			<?php echo $this->loadTemplate('sidebar'); ?>
		</div>

		<?php endif; ?>

	<?php endif; ?>

<div class="clr"></div>

<?php echo JHtml::_('artofgm.footer'); ?>
