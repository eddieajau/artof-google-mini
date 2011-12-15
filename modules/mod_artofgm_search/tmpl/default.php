<?php
/**
 * @package     NewLifeInIT
 * @subpackage  pl_artofgm_search
 * @copyright   Copyright 2011 New Life in IT Pty Ltd. All rights reserved.
 * @license     GNU General Public License version 2 or later.
 */

/* @var $params JRegistry */

// No direct access
defined('_JEXEC') or die;

// Shortcuts
$labelPos	= $params->get('label_pos', 'top');
$labelText	= $params->get('label_text', JText::_('MOD_ARTOFGM_SEARCH_LABEL'));
$buttonPos	= $params->get('button_pos', 'right');
$buttonText	= $params->get('button_text', JText::_('MOD_ARTOFGM_SEARCH_BUTTON'));
$site = $params->get('site');
$client = $params->get('client');

$label = '<label for="artofgm-q">'.$labelText.'</label>';
$input = '<input type="text" id="artofgm-q" name="q" size="'.$params->get('input_size', 20).'" maxlength="256" value="" />';
$button	= '<button type="submit">'.$buttonText.'</button>';

$output	= '';

// Add the label to the correct location.
switch ($labelPos):
    case 'top' :
	    $output = $label.'<br />'.$input;
	    break;

    case 'bottom' :
	    $output = $input.'<br />'.$label;
	    break;

    case 'right' :
	    $output = $input.' '.$label;
	    break;

    case 'left' :
	    $output = $label.' '.$input;
	    break;
endswitch;

// Add the button to the correct location.
switch ($buttonPos):
    case 'top' :
	    $output = $button.'<br />'.$output;
	    break;

    case 'bottom' :
	    $output = $output.'<br />'.$button;
	    break;

    case 'right' :
	    $output = $output.' '.$button;
	    break;

    case 'left' :
	    $output = $button.' '.$output;
	    break;
endswitch;
?>
<form id="google-search" method="post" action="<?php echo JRoute::_(ArtofGMHelperRoute::getRoute()); ?>" name="">
	<?php echo $output; ?>
	<?php if ($site) : ?>
	<input type="hidden" name="site" value="<?php echo $site; ?>" />
	<?php endif; ?>
	<?php if ($client) : ?>
	<input type="hidden" name="client" value="<?php echo $client; ?>" />
	<?php endif; ?>
</form>
