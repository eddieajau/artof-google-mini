<?php
/**
 * @package     NewLifeInIT
 * @subpackage  com_artofgm
 * @copyright   Copyright 2011 New Life in IT Pty Ltd. All rights reserved.
 * @license     GNU General Public License version 2 or later.
 */

// No direct access
defined('_JEXEC') or die;

$doc = new DOMDocument('1.0');
$doc->loadXML($this->state->get('server.response'));
$doc->formatOutput = true;
?>
<h1>
	<?php echo JText::_('COM_ARTOGM_RESPONSE_HEADING'); ?>
</h1>

<textarea cols="80" rows="10" style="width:100%;"><?php echo $doc->saveXML(); ?></textarea>