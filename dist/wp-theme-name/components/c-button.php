<?php
$label = isset($args) && isset($args['label']) ? $args['label'] : '';
$href = isset($args) && isset($args['href']) ? $args['href'] : '';
$title = isset($args) && isset($args['title']) ? $args['title'] : '';
$modifier = isset($args) && isset($args['modifier']) ? $args['modifier'] : '';
?>
<a href="<?php echo $href; ?>" class="c-button <?php echo $modifier; ?>" title="<?php echo $title; ?>" <?php echo ($modifier == 'c-button--external') ? 'target="_blank" rel="noreferrer external"':'' ;?>>
	<span class="c-button__label"><?php echo $label; ?></span>
	<span class="c-button__arrow"><span class="c-button__arrowIcon"></span></span>
</a>