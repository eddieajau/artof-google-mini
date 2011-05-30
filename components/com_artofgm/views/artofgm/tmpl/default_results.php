<?php
/**
 * @package		NewLifeInIT
 * @subpackage	com_artofgm
 * @copyright	Copyright 2011 New Life in IT Pty Ltd. All rights reserved.
 * @license		GNU General Public License version 2 or later.
 */

// No direct access
defined('_JEXEC') or die;

$mimes = array(
	'application/pdf' => 'PDF'
);

// Shortcuts.
$showSnips	= $this->params->get('show_snippet', true);
$showUrl	= $this->params->get('show_url', true);
$truncate	= $this->params->get('truncate_url');
$suffix		= $this->params->get('truncate_suffix');
$showSize	= $this->params->get('show_cached_size');
$showDate	= $this->params->get('show_crawl_date');

?>
<div class="results">
	<?php foreach ($this->items as $item) : ?>
		<?php if ($item->gm) : ?>
			<div class="gm">
				<a href="<?php echo $this->escape($item->gl);?>">
					<span class="l"><?php echo $item->gd;?></span></a>
				<p class="s">
					<span class="url">
						<?php echo $this->truncate($this->escape($item->gl), $truncate, $suffix);?><span>
				</p>
			</div>
		<?php else : // $item->gm ?>
			<?php if ($item->indent) : ?>
				<blockquote class="g">
			<?php endif; ?>
			<div class="g">
				<?php if ($item->mime && isset($mimes[$item->mime])) : ?>
				<small class="mime">[<?php echo $mimes[$item->mime]; ?>]</small>
				<?php endif; ?>
				<a href="<?php echo $this->escape($item->url);?>">
					<span class="l"><?php echo $item->title;?></span></a>

				<?php if ($showSnips || $showUrl) : ?>
				<p class="s">
					<?php if ($showSnips) : ?>
						<?php echo $item->snippet; ?>
						<br />
					<?php endif; ?>
					<?php if ($showUrl) : ?>
						<span class="url">
							<?php echo $this->truncate($this->escape($item->url), $truncate, $suffix);?>
							<?php if ($showSize && $item->size) : ?>
								<?php echo JText::sprintf('COM_ARTOFGM_CONTENT_SIZE', $item->size); ?>
							<?php endif; ?>
							<?php if ($showDate && $item->date) : ?>
								<?php echo JText::sprintf('COM_ARTOFGM_CRAWLDATE', $item->date); ?>
							<?php endif; ?>
						</span>
					<?php endif; ?>
				</p>
				<?php endif; ?>
			</div>
			<?php if ($item->indent) : ?>
				</blockquote>
			<?php endif; ?>
		<?php endif; // if $item->gm ?>
	<?php endforeach; ?>

	<div>
		<?php if (!$this->state->get('list.hasnext')) : ?>
			<span class="filtered"><?php echo JText::sprintf(
				'COM_ARTOFGM_FILTERED_SEARCH',
				$this->state->get('list.endnum'),
				JRoute::_(JFactory::getUri()->toString().'&filter=0')
			); ?></span>
		<?php endif; ?>

		<div class="rt-pagination">
			<?php echo $this->pagination->getPagesLinks(); ?>
			<p class="rt-results">
				<?php echo $this->pagination->getPagesCounter(); ?>
			</p>
		</div>
	</div>
</div>