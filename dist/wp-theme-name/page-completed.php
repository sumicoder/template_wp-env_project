<?php
/*
* Template Name: お問い合わせ 完了
*/
if (empty($_GET['from']) || !isset($_GET['from'])) {
	header('location:' . CONTACT_URL);
} else {
	switch ($_GET['from']) {
		default:
			break;
	}
};
?>
<?php get_header(); ?>
<?php get_footer(); ?>