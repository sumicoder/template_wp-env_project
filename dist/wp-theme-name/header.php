<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo("charset") ?>">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<meta name="format-detection" content="telephone=no">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> id="body">
	<header class="l-header" data-drawer-status="close" <?php echo (is_front_page()) ? 'style="opacity: 0;visibility: hidden;transform: translateY(2.5rem);" data-header-position="top"' : 'data-header-position="contents"'; ?>>
		<div class="l-header__inner">
		</div>
		<div class="l-headerDrawer" data-header-drawer>
			<div class="l-headerDrawer__header">
			</div>
			<div class="l-headerDrawer__inner">
			</div>
		</div>
	</header>
	<main class="l-main">